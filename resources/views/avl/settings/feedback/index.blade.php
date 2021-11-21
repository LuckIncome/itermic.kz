@extends('avl.default')

@section('main')
    <div class="card">
        <div class="card-header">
            <i class="fa fa-align-justify"></i> Обратная связь
        </div>
        <div class="card-body">

            <div class="table-responsive">
                @if ($feedbacks)
{{--                    @php $iteration = 30 * ($feedbacks->currentPage() - 1); @endphp--}}
                    <table class="table table-sm table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="40" class="text-center">#</th>
                            <th class="text-center">Имя</th>
                            <th class="text-center">Телефон</th>
                            <th class="text-center" style="width: 160px">Дата</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($feedbacks as $feedback)
                            <tr class="position-relative" id="news--item-{{ $feedback->id }}">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    {{ $feedback->name }}
                                </td>
                                <td>
                                    {{ $feedback->phone }}
                                </td>
                                <td>
                                    {{ $feedback->created_at }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
{{--                    <div class="d-flex justify-content-end">--}}
{{--                        {{ $news->appends($_GET)->links('vendor.pagination.bootstrap-4') }}--}}
{{--                    </div>--}}
                @endif
            </div>
        </div>
    </div>
@endsection
