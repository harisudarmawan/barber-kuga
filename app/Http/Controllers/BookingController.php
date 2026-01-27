<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\Booking;
use App\Models\Service;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $barbers = Barber::all();

        $selectedDate = request('booking_date')
    ?? old('booking_date')
    ?? now()->toDateString();

        // semua slot aktif
        $timeSlots = TimeSlot::where('is_active', true)
            ->orderBy('start_time')
            ->get();

        // jam yang sudah dibooking di tanggal itu
        $bookedTimes = Booking::where('booking_date', $selectedDate)
            ->pluck('booking_time')
            ->map(fn ($t) => substr($t, 0, 5))
            ->toArray();

        return view('kuga.booking', compact('services', 'barbers', 'bookedTimes', 'timeSlots', 'selectedDate'));
    }

    public function timeSlots(Request $request)
    {
        try {
            $request->validate([
                'date' => 'required|date',
            ]);

            $timeSlots = TimeSlot::where('is_active', true)
                ->orderBy('start_time')
                ->get();

            $bookedTimes = Booking::where('booking_date', $request->date)
                ->pluck('booking_time')
                ->map(fn ($t) => substr($t, 0, 5))
                ->toArray();

            return view('kuga.partials.time-slots', compact(
                'timeSlots',
                'bookedTimes'
            ));
        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function store(Request $request)
    {
        // 1. VALIDASI
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'service_id' => 'required|exists:services,id',
            'barber' => 'required|exists:barbers,id',
            'bookingDate' => 'required|date|after_or_equal:today',
            'bookingTime' => 'required',
            'notes' => 'nullable|string|max:500',
            'payment' => 'required|in:bca,mandiri,bni,dana,qris,bri',
            'payment_proof' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 2. AMBIL BARBER
        $selectedBarber = $request->barber === 'random'
            ? Barber::inRandomOrder()->first()
            : Barber::where('id', $request->barber)->first();

        if (! $selectedBarber) {
            return back()
                ->withInput()
                ->withErrors(['barber' => 'Barber yang dipilih tidak tersedia.']);
        }

        // 3. AMBIL SERVICE DARI DATABASE
        $service = Service::findOrFail($validated['service_id']);

        $totalPrice = $service->price;
        $dpAmount = $totalPrice * 0.5;
        $bookingCode = 'KGA-'.strtoupper(uniqid());

        try {
            DB::beginTransaction();

            // 4. UPLOAD BUKTI PEMBAYARAN
            $proofPath = $request->file('payment_proof')
                ->store('payment_proofs', 'public');

            // 5. SIMPAN BOOKING
            $booking = Booking::create([
                'booking_code' => $bookingCode,
                'name' => $validated['fullName'],
                'phone' => $validated['phone'],
                'email' => $validated['email'] ?? null,
                'service_id' => $service->id,
                'barber_id' => $selectedBarber->id,
                'booking_date' => $validated['bookingDate'],
                'booking_time' => $validated['bookingTime'],
                'notes' => $validated['notes'] ?? null,
                'payment_method' => $validated['payment'],
                'payment_status' => false,
                'total_price' => $totalPrice,
                'dp_amount' => $dpAmount,
                'proof_of_payment' => $proofPath,
            ]);

            DB::commit();

            return redirect()
                ->route('booking')
                ->with([
                    'success' => true,
                    'booking_code' => $bookingCode,
                    'booking_id' => $booking->id,
                    'dp_amount' => $dpAmount,
                    'payment_method' => $validated['payment'],
                ]);

        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error('Booking Store Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->withErrors([
                    'msg' => 'Terjadi kesalahan saat menyimpan booking. Silakan coba lagi.',
                ]);
        }
    }
}
