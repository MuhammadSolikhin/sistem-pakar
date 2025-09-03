<?php

function set_flash_message($type, $message)
{
    // Simpan pesan sebagai array di dalam session
    $_SESSION['flash_message'] = [
        'type' => $type,
        'message' => $message
    ];
}