@extends('layouts.app')
@section('title', 'Terima Kasih')

@push('styles')
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body { background-color: #fdf0e8 !important; font-family: 'Georgia', serif; }
    .slide {
    width: 100vw;
    min-height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-color: #fdf0e8;
}

    .c { position: absolute; border-radius: 50%; }

    .c1  { width: 80px;  height: 80px;  background: #c8a8e0; top: 6%;    left: 4%;    opacity:0.85; }
    .c2  { width: 32px;  height: 32px;  background: #b8e0b8; top: 16%;   left: 16%;   opacity:0.8; }
    .c3  { width: 28px;  height: 28px;  background: #f5e870; top: 5%;    left: 42%;   opacity:0.85; }
    .c4  { width: 65px;  height: 65px;  background: #b8e0b8; top: 3%;    right: 17%;  opacity:0.85; }
    .c5  { width: 180px;  height: 180px;  background: #f4a0b8; top: -13%;    right: -2%;   opacity:0.85; }
    .c6  { width: 28px;  height: 28px;  background: #f5e870; top: 20%;   right: 13%;  opacity:0.85; }
    .c7  { width: 35px;  height: 35px;  background: #f4a0b8; top: 46%;   left: 4%;    opacity:0.85; }
    .c8  { width: 30px;  height: 30px;  background: #a8c8f0; top: 62%;   left: 10%;   opacity:0.8; }
    .c9  { width: 55px;  height: 55px;  background: #c8a8e0; top: 30%;   right: 5%;   opacity:0.8; }
    .c10 { width: 160px;  height: 160px;  background: #f4a0b8; bottom: -8%; left: -2%;    opacity:0.8; }
    .c11 { width: 35px;  height: 35px;  background: #b8e0b8; bottom: 13%; left: 35%;  opacity:0.85; }
    .c12 { width: 70px;  height: 70px;  background: #f5c89a; bottom: 5%; left: 50%;   opacity:0.85; }
    .c13 { width: 38px;  height: 38px;  background: #b8e0b8; bottom: 16%; right: 8%;  opacity:0.8; }
    .c14 { width: 50px;  height: 50px;  background: #f4a0b8; bottom: 4%; right: 4%;   opacity:0.8; }

    .thankyou-box {
    background: rgba(255,255,255,0.8);
    border-radius: 14px;
    padding: 2.2rem 4rem;
    text-align: left;
    z-index: 1;
    position: absolute;
    top: 45%;
    transform: translateY(-50%);
}

    .thankyou-box h2 {
        font-size: 1.5rem;
        color: #555;
        font-weight: 400;
        letter-spacing: 0.22em;
        line-height: 1.5;
        font-family: 'Georgia', serif;
    }

    .btn-next {
    position: absolute;
    bottom: 12%;
    background: #ffffff;
    border: 1px solid #ccc;
    border-radius: 50px;
    padding: 0.55rem 1.8rem;
    font-size: 0.9rem;
    color: #666;
    text-decoration: none;
    display: inline-block;
    z-index: 1;
}
</style>
@endpush

@section('content')
<div class="slide">
    <div class="c c1"></div>
    <div class="c c2"></div>
    <div class="c c3"></div>
    <div class="c c4"></div>
    <div class="c c5"></div>
    <div class="c c6"></div>
    <div class="c c7"></div>
    <div class="c c8"></div>
    <div class="c c9"></div>
    <div class="c c10"></div>
    <div class="c c11"></div>
    <div class="c c12"></div>
    <div class="c c13"></div>
    <div class="c c14"></div>

    <div class="thankyou-box">
        <h2>Terimakasih  Sudah  Menjawab</h2>
    </div>

    <a href="{{ route('ekskul.hasil') }}" class="btn-next">Next</a>
</div>
@endsection