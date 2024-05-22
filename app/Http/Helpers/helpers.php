<?php
    use Carbon\Carbon;
    function formatToRupiah($amount)
    {
        return 'Rp. ' . number_format($amount, 0, ',', '.') . ',-';
    }

    function formatToKg($amount)
    {
        return number_format($amount, 0, ',', '.') . ' Kg';
    }

    function formatToDate($date)
    {
        // Ubah format tanggal menjadi format Carbon
        $carbonDate = Carbon::parse($date);

        // Format tanggal dalam bahasa Indonesia
        setlocale(LC_TIME, 'id_ID.utf8');
        Carbon::setLocale('id');

        return $carbonDate->isoFormat('DD-MMMM-YYYY');
    }

    function cleanAndImplodeArray($string) {
        // Ubah string JSON menjadi array
        $array = json_decode($string, true);
    
        // Bersihkan array dari nilai kosong
        $cleanedArray = array_filter($array);
    
        // Gabungkan nilai-nilai array dengan koma sebagai pemisah
        $resultString = implode(',', $cleanedArray);
    
        return $resultString ;
    }