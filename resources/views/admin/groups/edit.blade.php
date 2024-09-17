<x-admin-layout>
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">

                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head nk-block-head-sm">
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt"><a href="{{ route('groups.index') }}" class="btn btn-outline-primary"><em class="dd-indc icon ni ni-chevron-left"></em><span>Все группы</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->

                            <div class="nk-block-head-content mt-4">
                                <h5 class="nk-block-title">Редактирование группы</h5>
                            </div><!-- .nk-block-head-content -->

                        </div><!-- .nk-block-head -->
                        <div class="card">
                            <div class="card-inner">
                                <form action="{{ route('groups.update', $group->id) }}" method="post" class="gy-3">
                                    @csrf
                                    @method('PUT')

                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label fw-bold" for="site-name">Название группы</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="text" name="name" value="{{ old('name', $group->name) }}" class="form-control" id="site-name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label fw-bold">Описание</label>
                                                <span class="form-note">Заметка для себя.</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <textarea name="description" rows="3" class="form-control" id="site-email">{{ old('description', $group->description) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label fw-bold">Выбрать вуз</label>
                                                <span class="form-note">Список всех вузов из базы данных</span>
                                            </div>
                                        </div>

                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap ">
                                                    <div class="form-control-select">
                                                        <select name="university" class="form-control" id="default-16" required>
                                                            <option value="">Выбрать вуз</option>
                                                            @foreach($universities as $university)
                                                                <option value="{{ $university->id }}"  @selected($university->id == $current_university_id)>{{ $university->name }}</option>
{{--                                                                <option value="{{ $university->id }}"  @selected($group->university->contains($current_university_id))>{{ $university->name }}</option>--}}
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label fw-bold">Дата старта</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <div class="form-icon form-icon-left">
                                                        <em class="icon ni ni-calendar"></em>
                                                    </div>
                                                    <input type="text" value="{{ old('start_at', $group->start_at) }}" name="start_at" class="form-control date-picker-vuz" data-date-format="dd-mm-yyyy">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3 align-center">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <label class="form-label fw-bold">Ведущий</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="form-group">
                                                <div class="form-control-wrap">
                                                    <input type="text" value="{{ old('teachers', $group->teachers) }}" name="teachers" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row g-3">
                                        <div class="col-lg-7 offset-lg-5">
                                            <div class="form-group mt-2">
                                                <button type="submit" class="btn btn-lg btn-primary">Сохранить</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- card -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->

</x-admin-layout>
