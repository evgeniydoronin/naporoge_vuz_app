<x-admin-layout>
    @php
        $tz = new \App\Etc\UniversityTimezone();
    @endphp

    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li class="nk-block-tools-opt"><a href="{{ route('universities.index') }}" class="btn btn-outline-primary"><em class="dd-indc icon ni ni-chevron-left"></em><span>Все вузы</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- .nk-block-head-content -->

                        <div class="nk-block-head-content mt-4">
                            <h5 class="nk-block-title">Редактирование вуза</h5>
                        </div><!-- .nk-block-head-content -->

                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="row g-gs">

                            <div class="col-xxl-12 col-md-12">
                                <div class="card card-full overflow-hidden">
                                    <div class="nk-ecwg nk-ecwg7 h-100">
                                        <div class="card-inner flex-grow-1">
                                            <div class="card-title-group mb-2">
                                                <div class="card-title">
                                                    <h6 class="title">Наименование учебного заведения</h6>
                                                </div>
                                            </div>
                                            <form action="{{ route('universities.update', $university->id) }}" method="post" class="form-validate-vuz">
                                                @csrf
                                                @method('PUT')

                                                <div class="row g-gs">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <input type="text" name="name" value="{{ old('name', $university->name) }}" placeholder="Наименование учебного заведения" class="form-control" id="fv_full_name" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap ">
                                                                <div class="form-control-select">
                                                                    <select name="timezone" class="form-control" id="default-06" required>
                                                                        <option value="">Выбрать часовой пояс</option>
                                                                        @foreach($tz->getTimezone() as $k => $v)
                                                                            <option value="{{ $k }}" @selected($university->timezone == $k)>{{ $v }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <textarea name="comment" class="form-control no-resize" id="default-textarea">{{ old('comment', $university->comment) }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-lg btn-primary">Сохранить</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>


                                        </div><!-- .card-inner -->
                                    </div>
                                </div><!-- .card -->
                            </div><!-- .col -->

                            <div class="col-xxl-12 col-md-12">
                                <div class="card h-100">
                                    <div class="card-inner">
                                        <div class="card-title-group mb-2">
                                            <div class="card-title">
                                                <h6 class="title">Группы</h6>
                                            </div>
                                        </div>
                                        <table class="table mt-3">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Название группы</th>
                                                <th scope="col">Ведущий</th>
                                                <th scope="col" class="tb-col-action">Дата запуска</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($groups as $group)
                                            <tr>
                                                <td scope="row">{{ $group->id }}</td>
                                                <td><a href="{{ route('groups.edit', $group->id) }}">{{ $group->name }}</a></td>
                                                <td>{{ $group->teachers }}</td>
                                                <td class="tb-col-action">{{ Carbon\Carbon::parse($group->start_at)->format('d-m-Y') }}</td>
                                            </tr>
                                            @empty
                                                <p>Нет записей</p>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div><!-- .card-inner -->
                                </div><!-- .card -->
                            </div><!-- .col -->

                        </div><!-- .row -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->

</x-admin-layout>
