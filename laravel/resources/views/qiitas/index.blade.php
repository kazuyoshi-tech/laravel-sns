@extends('app')

@section('title', '記事一覧')

@section('content')
@include('nav')
<div class="container">
   <i>今からAPI引っ張ってくるお</i>
   @foreach($qiitas as $qiita)
      <p>{{ $qiita }}</p>
   @endforeach
</div>
@endsection