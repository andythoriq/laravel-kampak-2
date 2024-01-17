@extends('layouts.landingpage', ['title' => 'Landing Page'])

@section('content')
    <div class="kiri-atas">
        <fieldset>
            <center>
                <button onclick="showLoginAdmin()" class="button-primary">Admin</button>
                <button onclick="showLoginGuru()" class="button-primary">Guru</button>
                <button onclick="showLoginSiswa()" class="button-primary">Siswa</button>
                <hr />
                Pilih role yang sesuai dengan posisi anda
                <hr />
            </center>

            <x-logincard>
                @slot('id', "login_admin")
                @slot('title', "Login Admin")
                @slot('route', route('login.admin'))
                @slot('unique_field_label', "Kode Admin")
                @slot('unique_field_name', "admin_number")
            </x-logincard>

            <x-logincard>
                @slot('id', "login_guru")
                @slot('title', "Login Guru")
                @slot('route', route('login.teacher'))
                @slot('unique_field_label', "NIP")
                @slot('unique_field_name', "nip")
            </x-logincard>

            <x-logincard>
                @slot('id', "login_siswa")
                @slot('title', "Login Siswa")
                @slot('route', route('login.student'))
                @slot('unique_field_label', "NIS")
                @slot('unique_field_name', "nis")
            </x-logincard>
        </fieldset>
    </div>

    <div class="kanan">
        <center>
            <x-alert />
            <h1>
                SELAMAT DATANG <br /> Di Website Penilaian SMK Negeri 1 Cibinong
            </h1>
        </center>
    </div>

    <div class="kiri-bawah">
        <center>
            <p class="mar"><b>Gallery</b></p>
            <div class="gallery">
                <img src="{{ asset('img/suasana-belajar-rpl.jpg') }}" alt="gallery"/>
                <div class="deskripsi">
                    SMK Bisa {{ date('Y') < 2024 ? 2024 : date('Y') }}
                </div>
            </div>
        </center>
    </div>
@endsection
