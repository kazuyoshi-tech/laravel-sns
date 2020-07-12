@extends('app')

@section('title', '記事一覧')

@section('content')
@include('nav')
<div class="container">
   <br>
   <i>今からAPI引っ張ってくるお</i>
   <br>
   <br>
   @foreach($qiitas as $qiita)
      <p>{{ $qiita['Title'] }} | {{ $qiita['Tags'] }}</p>
   @endforeach
</div>
@endsection