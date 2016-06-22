@extends('layouts.app')

@section('stykes-before')
    <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css') }}">
    <style>
        body {
            padding: 25px;
        }

        h1 {
            font-size: 1.5em;
            margin-top: 0px;
        }

        .stack {
            font-size: 0.85em;
        }

        .date {
            min-width: 75px;
        }

        .text {
            word-break: break-all;
        }

        a.llv-active {
            z-index: 2;
            background-color: #f5f5f5;
            border-color: #777;
        }
    </style>
@stop
@section('content')
    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-sm-3 col-md-2">
                <h1><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Logs do<br> Sistema</h1>

                <div class="list-group">
                    @foreach($files as $file)
                        <a href="?l={{ base64_encode($file) }}"
                           class="list-group-item @if ($current_file == $file) llv-active @endif">
                            {{$file}}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-7 col-md-8">
                @if ($logs === null)
                    <div>
                        Log file >50M, please download it.
                    </div>
                @else
                    <table id="table-log" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Tipo</th>
                            <th>Data</th>
                            <th>Conteúdo</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($logs as $key => $log)
                            <tr>
                                <td class="text-{{{$log['level_class']}}}"><span
                                            class="glyphicon glyphicon-{{{$log['level_img']}}}-sign"
                                            aria-hidden="true"></span> &nbsp;{{$log['level']}}</td>
                                <td class="date">{{{$log['date']}}}</td>
                                <td class="text">
                                    @if ($log['stack']) <a class="pull-right expand btn btn-default btn-xs"
                                                           data-display="stack{{{$key}}}"><span
                                                class="glyphicon glyphicon-search"></span></a>@endif
                                    {{{$log['text']}}}
                                    @if (isset($log['in_file'])) <br/>{{{$log['in_file']}}}@endif
                                    @if ($log['stack'])
                                        <div class="stack" id="stack{{{$key}}}"
                                             style="display: none; white-space: pre-wrap;">{{{ trim($log['stack']) }}}
                                        </div>@endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                @endif
                <div>
                    <a href="?dl={{ base64_encode($current_file) }}"><span
                                class="glyphicon glyphicon-download-alt"></span> Baixar Arquivo</a>
                    -
                    <a id="delete-log" href="?del={{ base64_encode($current_file) }}"><span
                                class="glyphicon glyphicon-trash"></span> Deletar Arquivo</a>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts-before')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#table-log').DataTable({
                "order": [1, 'desc'],
                "stateSave": true,
                "language": {
                    url: "plugins/datatables/pt_BR.json"
                },
                "stateSaveCallback": function (settings, data) {
                    window.localStorage.setItem("datatable", JSON.stringify(data));
                },
                "stateLoadCallback": function (settings) {
                    var data = JSON.parse(window.localStorage.getItem("datatable"));
                    if (data) data.start = 0;
                    return data;
                }
            });
            $('.table-container').on('click', '.expand', function () {
                $('#' + $(this).data('display')).toggle();
            });
            $('#delete-log').click(function () {
                return confirm('Are you sure?');
            });
        });
    </script>
@stop
