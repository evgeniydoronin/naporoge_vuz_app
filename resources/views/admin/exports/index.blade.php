<x-admin-layout>
  <!-- content @s -->
  <div class="nk-content ">
    <div class="container-fluid">
      <div class="nk-content-inner">
        <div class="nk-content-body">
          <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
              <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Экспорт</h3>
              </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
          </div><!-- .nk-block-head -->

          <div class="nk-block">
            <div class="row g-gs">

              <div class="col-xxl-12 col-md-12">
                <div class="card h-100">
                  <div class="card-inner">
                    <form action="{{ route('exports.store') }}" method="post" class="form-validate">
                      @csrf
                      <div class="row g-gs">

                        <script>
                            // Функция для выбора/снятия выбора всех чекбоксов
                            const toggleCheckboxes = (selectAll) => {
                                const checkboxes = document.querySelectorAll('#groups-tbody input[type="checkbox"]');
                                checkboxes.forEach((checkbox) => {
                                    checkbox.checked = selectAll;
                                });
                                updateSubmitButtonState();
                            };

                            // Функция для обновления обработчиков событий на чекбоксах внутри <tbody>
                            const updateCheckboxes = () => {
                                const checkboxes = document.querySelectorAll('#groups-tbody input[type="checkbox"]');

                                checkboxes.forEach((checkbox) => {
                                    checkbox.removeEventListener('change', checkboxChangeHandler);
                                    checkbox.addEventListener('change', checkboxChangeHandler);
                                });
                                updateSubmitButtonState();
                            };

                            // Обработчик изменения состояния отдельного чекбокса
                            const checkboxChangeHandler = () => {
                                const checkboxes = document.querySelectorAll('#groups-tbody input[type="checkbox"]');
                                const selectAllCheckbox = document.getElementById('select-all-items');
                                selectAllCheckbox.checked = Array.from(checkboxes).every((cb) => cb.checked);
                                updateSubmitButtonState();
                            };

                            // Функция для обновления состояния кнопки отправки
                            const updateSubmitButtonState = () => {
                                const submitButton = document.querySelector('button[type="submit"]');
                                const checkboxes = document.querySelectorAll('#groups-tbody input[type="checkbox"]');
                                const anyChecked = Array.from(checkboxes).some((cb) => cb.checked);
                                submitButton.disabled = !anyChecked;
                            };

                            // Функции для загрузки данных и динамического добавления чекбоксов
                            async function selectUniversity(selectObject) {
                                let universityID = selectObject.value;
                                let url = `${location.origin}/dashboard/getDatesByUniversity/${universityID}`;
                                let response = await fetch(url);

                                if (response.ok) {
                                    let universityGroups = await response.json();
                                    let datesSelect = document.getElementById('dates-select');
                                    let table = document.getElementById("groups-tbody");
                                    const selectAllCheckbox = document.getElementById('select-all-items');

                                    // Сбрасываем чекбокс "select-all-items"
                                    selectAllCheckbox.checked = false;

                                    removeOptions(datesSelect);
                                    table.innerHTML = '';

                                    if (universityGroups.length > 0) {
                                        const dateSelectItems = Object.values(
                                            universityGroups.reduce((acc, obj) => ({
                                                ...acc,
                                                [obj.start_at]: obj.start_at
                                            }), {})
                                        );

                                        for (let i = 0; i < dateSelectItems.length; i++) {
                                            const universityId = universityGroups[i]['university_id'];
                                            const groupStartAt = universityGroups[i]['start_at'];
                                            const newOption = document.createElement('option');
                                            const optionText = document.createTextNode(groupStartAt);
                                            newOption.appendChild(optionText);
                                            newOption.setAttribute('value', universityId);
                                            datesSelect.appendChild(newOption);
                                        }

                                        for (let i = 0; i < universityGroups.length; i++) {
                                            const groupID = universityGroups[i]['id'];
                                            const groupStartAt = universityGroups[i]['start_at'];
                                            const groupName = universityGroups[i]['name'];
                                            const groupTeachers = universityGroups[i]['teachers'];

                                            let row = document.createElement("tr");

                                            let c1Checkbox = document.createElement("td");
                                            let c2ID = document.createElement("td");
                                            let c3Name = document.createElement("td");
                                            let c4Date = document.createElement("td");
                                            let c5Teacher = document.createElement("td");

                                            c1Checkbox.innerHTML = `<input type='checkbox' name='group_id_${universityGroups[i]['id']}' id='${universityGroups[i]['id']}'>`;
                                            c2ID.innerText = groupID;
                                            c3Name.innerText = groupName;
                                            c4Date.innerText = groupStartAt;
                                            c5Teacher.innerText = groupTeachers;

                                            row.appendChild(c1Checkbox);
                                            row.appendChild(c2ID);
                                            row.appendChild(c3Name);
                                            row.appendChild(c4Date);
                                            row.appendChild(c5Teacher);

                                            table.appendChild(row);
                                        }

                                        // Обновляем обработчики событий на новых чекбоксах
                                        updateCheckboxes();
                                    }
                                } else {
                                    console.log("Ошибка HTTP: getGroups(id) : " + response.status);
                                }
                            }

                            async function selectGroupsByDate(selectObject) {
                                let universityID = selectObject.value;
                                let startAt = selectObject.options[selectObject.selectedIndex].text;
                                let url = `${location.origin}/dashboard/getDatesByUniversity/${universityID}`;
                                let response = await fetch(url);

                                if (response.ok) {
                                    let universityGroups = await response.json();
                                    let table = document.getElementById("groups-tbody");
                                    const selectAllCheckbox = document.getElementById('select-all-items');

                                    // Сбрасываем чекбокс "select-all-items"
                                    selectAllCheckbox.checked = false;

                                    table.innerHTML = '';

                                    let groupsByDate = universityGroups.filter(function (group) {
                                        return group.start_at === startAt;
                                    });

                                    if (groupsByDate.length > 0) {
                                        for (let i = 0; i < groupsByDate.length; i++) {
                                            const groupID = groupsByDate[i]['id'];
                                            const groupStartAt = groupsByDate[i]['start_at'];
                                            const groupName = groupsByDate[i]['name'];
                                            const groupTeachers = groupsByDate[i]['teachers'];

                                            let row = document.createElement("tr");

                                            let c1Checkbox = document.createElement("td");
                                            let c2ID = document.createElement("td");
                                            let c3Name = document.createElement("td");
                                            let c4Date = document.createElement("td");
                                            let c5Teacher = document.createElement("td");

                                            c1Checkbox.innerHTML = `<input type='checkbox' name='group_id_${groupsByDate[i]['id']}' id='${groupsByDate[i]['id']}'>`;
                                            c2ID.innerText = groupID;
                                            c3Name.innerText = groupName;
                                            c4Date.innerText = groupStartAt;
                                            c5Teacher.innerText = groupTeachers;

                                            row.appendChild(c1Checkbox);
                                            row.appendChild(c2ID);
                                            row.appendChild(c3Name);
                                            row.appendChild(c4Date);
                                            row.appendChild(c5Teacher);

                                            table.appendChild(row);
                                        }

                                        // Обновляем обработчики событий на новых чекбоксах
                                        updateCheckboxes();
                                    }
                                } else {
                                    console.log("Ошибка HTTP: getGroups(id) : " + response.status);
                                }
                            }

                            // сброс опций
                            function removeOptions(selectElement) {
                                let i, L = selectElement.options.length - 1;
                                for (i = L; i > 0; i--) {
                                    selectElement.remove(i);
                                }
                            }

                            document.addEventListener('DOMContentLoaded', (event) => {
                                // Получаем чекбокс "select-all-items"
                                const selectAllCheckbox = document.getElementById('select-all-items');

                                // Событие при клике на чекбокс "select-all-items"
                                selectAllCheckbox.addEventListener('change', (event) => {
                                    toggleCheckboxes(event.target.checked);
                                });

                                // Изначально обновляем обработчики для имеющихся чекбоксов
                                updateCheckboxes();
                            });



                        </script>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label" for="universities-select">Вуз</label>
                            <div class="form-control-wrap ">
                              <div class="form-control-select">
                                <select name="university_id" onchange="selectUniversity(this)" class="form-control"
                                        id="universities-select" required>
                                  <option value="">Выбрать</option>
                                  @foreach($universities as $university)
                                    <option value="{{ $university->id }}">{{ $university->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label" for="dates-select">Дата</label>
                            <div class="form-control-wrap ">
                              <div class="form-control-select">
                                <select name="date_id" class="form-control" onchange="selectGroupsByDate(this)"
                                        id="dates-select">
                                  <option value="">Выбрать</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-12">
                          <table class="table" id="groups-table">
                            <thead>
                            <tr>
                              <th width="20px">
                                <input type="checkbox" name="select-all-items" id="select-all-items">
                              </th>
                              <th width="100px" scope="col">ID</th>
                              <th scope="col">Название</th>
                              <th width="150px" scope="col">Дата</th>
                              <th scope="col">Ведущие</th>
                            </tr>
                            </thead>
                            <tbody id="groups-tbody">
                            </tbody>
                          </table>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary" disabled>Экспорт</button>
                          </div>
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
</x-admin-layout>