<x-app-layout>
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">

                        <div class="nk-block-head-content mt-4">
                            <h5 class="nk-block-title">Создать группу кодов</h5>
                        </div><!-- .nk-block-head-content -->

                    </div><!-- .nk-block-head -->
                    <div class="nk-block">
                        <div class="row g-gs">

                            <div class="col-xxl-12 col-md-12">
                                <div class="card h-100">
                                    <div class="card-inner">
                                        <form action="{{ route('codes.store') }}" method="post" class="form-validate">
                                            @csrf
                                            <div class="row g-gs">

                                                <script>
                                                    function selectUniversity(selectObject) {
                                                        let universityID = selectObject.value;
                                                        // console.log(universityID);

                                                        let groupsSelect = document.getElementById('groups-select');
                                                        // remove old options
                                                        while (groupsSelect.options.length > 1) {
                                                            groupsSelect.remove(1);
                                                        }

                                                        getGroups(universityID);
                                                    }

                                                    async function getGroups(id) {
                                                        let url = `${location.origin}/getGroupsByUniversity/${id}`;
                                                        let response = await fetch(url);

                                                        if (response.ok) {

                                                            let universityGroups = await response.json();
                                                            let groupsSelect = document.getElementById('groups-select');

                                                            if (universityGroups.length > 0) {
                                                                for (let i = 0; i < universityGroups.length; i++) {
                                                                    const groupID = universityGroups[i]['id']
                                                                    const groupName = universityGroups[i]['name']

                                                                    // create option using DOM
                                                                    const newOption = document.createElement('option');
                                                                    const optionText = document.createTextNode(groupName);
                                                                    // set option text
                                                                    newOption.appendChild(optionText);
                                                                    // and option value
                                                                    newOption.setAttribute('value', groupID);

                                                                    groupsSelect.appendChild(newOption);
                                                                }
                                                            }

                                                        } else {
                                                            console.log("Ошибка HTTP: getGroups(id) : " + response.status);
                                                        }
                                                    }
                                                </script>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="universities-select">Вуз</label>
                                                        <div class="form-control-wrap ">
                                                            <div class="form-control-select">
                                                                <select name="university_id" onchange="selectUniversity(this)" class="form-control" id="universities-select" required>
                                                                    <option value="">Выбрать</option>
                                                                    @foreach($universities as $university)
                                                                    <option value="{{ $university->id }}">{{ $university->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="groups-select">Группа</label>
                                                        <div class="form-control-wrap ">
                                                            <div class="form-control-select">
                                                                <select name="group_id" class="form-control"  id="groups-select" required>
                                                                    <option value="">Выбрать</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label" for="default-06">Количество</label>
                                                        <div class="form-control-wrap">
                                                            <input type="number" name="code" min="1" max="100" class="form-control" id="fv-full-name-group" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group"><button type="submit" class="btn btn-lg btn-primary">Создать</button></div>
                                                </div>
                                            </div>
                                        </form>
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

</x-app-layout>
