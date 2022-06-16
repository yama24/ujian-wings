@extends('_layout')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Card title</h5> --}}
                            @foreach($transaction_details as $td)
                            <div class="info-box">
                                <span class="info-box-icon"><img class="img-circle elevation-2"
                                        src="data:image/png;base64,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"
                                        alt="User Avatar"></span>
    
                                <div class="info-box-content">
                                    {{-- <span class="info-box-text"><a
                                            href="product_detail/{{ $item->Product_Code }}">{{ $item->Product_Name }}</a></span>
                                    <small><span class="info-box-number mb-0 mt-0">{!! $item->Discount ? '<strike>Rp. ' . number_format($item->Price, 0, ',', '.') . '</strike>' : '' !!}</span></small>
                                    <span class="info-box-number mb-0 mt-0">Rp.
                                        {{ number_format($item->Price - ($item->Price * $item->Discount) / 100, 0, ',', '.') }}</span>
                                    <button class="btn btn-xs btn-success" id="{{ $item->id }}"
                                        onclick="buy('{{ $item->id }}')">BUY</button> --}}
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            @endforeach
                                <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div><!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('app.js')
    <script src="{{ asset('app.js') }}"></script>
@endsection
