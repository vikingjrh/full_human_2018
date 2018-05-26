<?php
use App\Library\AdminFunction\FunctionLib;
use App\Library\AdminFunction\Define;
use App\Http\Models\Hr\Salary;
use App\Http\Models\Hr\Allowance;
use App\Http\Models\Hr\Person;
?>

@extends('admin.AdminLayouts.index')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="main-content-inner">
        <div class="breadcrumbs breadcrumbs-fixed" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="{{URL::route('admin.dashboard')}}">{{FunctionLib::viewLanguage('home')}}</a>
                </li>
                <li class="active">Báo cáo danh sách và tiền lương công chức {{(isset($search['reportYear']) && $search['reportYear'] > 0) ? $search['reportYear'] : ''}}</li>
            </ul>
        </div>
        <div class="page-content">
            <div class="panel panel-default">
                {{ csrf_field() }}
                <div class="panel-body-ns">
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <div class="line">
                                <div class="panel-body">
                                    <form class="form-horizontal" action="" method="get" id="adminFormExportViewTienLuongCongChuc" name="adminFormExportViewTienLuongCongChuc">
                                        <div class="form-group">
                                            <div class="col-md-4">
                                                <label>Chọn Đơn vị/ Phòng ban</label>
                                                <select class="form-control input-sm" name="person_depart_id">
                                                    <option value="">- Đơn vị/ Phòng ban -</option>
                                                   {!! $optionDepart !!}
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Chọn tháng báo cáo</label>
                                                <select class="required form-control input-sm" name="reportMonth">
                                                    {!! $optionMonth !!}
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Chọn năm báo cáo</label>
                                                <select class="required form-control input-sm" name="reportYear">
                                                    <option value="">---Chọn năm
                                                        ---</option>
                                                    {!! $optionYear !!}
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label>&nbsp;</label>
                                                <div class="input-group-btn">
                                                    <button class="btn btn-primary btn-sm clickFormReportLuong" type="submit"><i class="fa fa-area-chart"></i>&nbsp;Thống kê</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    @if($is_root == 1 || $exportTienLuongCongChuc == 1)
                                    <div class="col-md-2">
                                        <label>&nbsp;</label>
                                        <div class="input-group-btn">
                                            <a href="{{URL::route('hr.viewTienLuongCongChuc')}}" class="btn btn-warning btn-sm exportViewTienLuongCongChuc">
                                                <i class="fa fa-file-excel-o"></i> Xuất ra file
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="span clearfix"> @if($total >0) Có tổng số <b>{{$total}}</b> nhân sự @endif </div>
                                            <br>
                                            <div class="line">
                                                <table style="width: 100%;" class="table table-bordered table-responsive">
                                                    <tbody>
                                                    <tr class="text-center">
                                                        <th class="text-center">TT</th>
                                                        <th class="text-center" width="20%">Họ và tên</th>
                                                        <th class="text-center" width="8%">Lương tháng</th>
                                                        <th class="text-center" width="15%">Lương hợp đồng</th>
                                                        <th class="text-center" width="15%">% lương thực nhận</th>
                                                        <th class="text-center" >Tiền phụ cấp</th>
                                                        <th class="text-center" >Các khoản trừ vào lương (BHXH)</th>
                                                        <th class="text-center">Tổng tiền lương thực nhận</th>
                                                    </tr>
                                                    <tr class="text-center" style="background-color: #62A8D1">
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    @if(sizeof($data) > 0)
                                                        @foreach($data as $k=>$item)
                                                            <tr>
                                                                <td>{{$stt+$k+1}}</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td class="text-left">
                                                                    {{isset($arrPerson[$item->payroll_person_id]['person_name']) ? $arrPerson[$item->payroll_person_id]['person_name'] : ''}}
                                                                    <br/>
                                                                    @if($item->payroll_month > 0 && $item->payroll_year > 0)
                                                                        {{$item->payroll_month}}/{{$item->payroll_year}}
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop