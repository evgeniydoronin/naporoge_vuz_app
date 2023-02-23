<x-app-layout>
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Активационные коды</h3>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->

                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="datatable-init-codes table">
                                    <thead>
                                    <tr>
                                        <th class="w-150px">id</th>
                                        <th class="w-200px">Код</th>
                                        <th class="w-50">Вуз</th>
                                        <th class="w-50">Группа</th>
                                        <th class="tb-col-action">Активирован</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($codes as $code)
                                    <tr>
                                        <td>{{ $code->id }}</td>
                                        <td>{{ $code->code }}</td>
                                        <td>{{ \App\Models\Code::find($code->id)->university['name'] }}</td>
                                        <td>{{  \App\Models\Code::find($code->id)->group['name']  }}</td>
                                        @if($code->is_activated)
                                        <td class="text-center text-success">Да</td>
                                        @else
                                        <td class="text-center text-danger">Нет</td>
                                        @endif
                                    </tr>
                                    @empty
                                        <p>Нет записей</p>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->


                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
</x-app-layout>
