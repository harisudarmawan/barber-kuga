
// 1. Setup Data
$customerPhone = '081299999999'; // Explicit CUSTOMER number
$adminPhone = env('ADMIN_PHONE', 'UNKNOWN_ADMIN');

echo "--- TEST CONFIGURATION ---\n";
echo "Customer Phone: {$customerPhone}\n";
echo "Admin Phone   : {$adminPhone}\n";
echo "--------------------------\n";

// Ensure dependencies
$service = \App\Models\Service::first();
if (!$service) {
    try {
        $service = \App\Models\Service::create(['name' => 'Test Service', 'price' => 50000, 'duration' => 30]);
    } catch (\Exception $e) {}
}
$barber = \App\Models\Barber::first();
if (!$barber) {
    try {
        $barber = \App\Models\Barber::create(['name' => 'Test Barber', 'phone' => '08111111111']);
    } catch (\Exception $e) {}
}

// 2. Create Booking
try {
    $booking = \App\Models\Booking::create([
        'booking_code'  => 'TEST-CUST-' . time(),
        'name'          => 'Test Customer',
        'phone'         => $customerPhone, // <--- Using the customer phone
        'service_id'    => $service->id,
        'barber_id'     => $barber->id,
        'booking_date'  => now()->addDay(),
        'booking_time'  => '14:00',
        'status'        => \App\Enums\StatusBookingEnum::WAITING_PAYMENT->value,
        'dp_amount'     => 20000,
        'total_price'   => 50000,
    ]);

    echo "Booking created. ID: {$booking->id}. Phone: {$booking->phone}\n";

    // 3. Update Status (Trigger Observer)
    echo "Updating status to CONFIRMED...\n";
    $booking->update(['status' => \App\Enums\StatusBookingEnum::CONFIRMED->value]);

    echo "Status updated.\n";
    echo "Please check logs to confirm message was sent to {$customerPhone}.\n";

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
