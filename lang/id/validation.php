<?php

return [

    'required' => ':attribute wajib diisi.',
    'string' => ':attribute harus berupa teks.',
    'email' => ':attribute harus berupa email yang valid.',
    'image' => ':attribute harus berupa gambar.',
    'mimes' => ':attribute harus berformat: :values.',
    'max' => ':attribute maksimal :max kilobytes.',
    'date' => ':attribute harus berupa tanggal.',
    'after_or_equal' => ':attribute harus hari ini atau setelahnya.',

    'attributes' => [
        'fullName' => 'Nama lengkap',
        'phone' => 'Nomor telepon',
        'email' => 'Email',
        'service' => 'Layanan',
        'barber' => 'Barber',
        'bookingDate' => 'Tanggal booking',
        'bookingTime' => 'Jam booking',
        'payment' => 'Metode pembayaran',
        'notes' => 'Catatan',
        'payment_proof' => 'Bukti pembayaran',
    ],
];
