@extends('layouts.app')

@section('title','آپلود فایل')
@section('links')
<link rel="stylesheet" href="{{asset('css/style.css')}}">

@section('content')
<div class="table-users">
    <table cellspacing="0">
      <thead class="fixedHeader">
        <tr>
          <th>عنوان</th>
          <th width="100px">کاربر</th>
          <th>اولویت</th>
          <th>وضعیت</th>
          <th>تاریخ ساخت</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($tickets as $ticket)
        <tr>
            <td>{{$ticket->title}}</td>
            <td>{{$ticket->user->name}}</td>
            <td>{{$ticket->periority}}</td>
            <td>{{$ticket->status}}</td>
            <td>{{$ticket->created_at}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
