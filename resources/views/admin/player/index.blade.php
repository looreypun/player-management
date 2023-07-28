<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

@section('title', 'Players')

@section('content_header')
  <h1>PLAYERS</h1>
@stop

@section('content')
    <div id="player-index" v-cloak>
        {{-- メッセージ --}}
        <div v-if="showAlert" v-bind:class="'alert-'+alertType" class="alert alert-dismissible card sticky-top">
            <button type="button" class="close" data-dismiss="alert" @click="toggleAlert('', 'dismiss')" aria-hidden="true">×</button>
            @{{ message }}
        </div>

        <div class="p-0">
            {{-- 検索フォーム --}}
            <div class="card">
                <div class="card-body small row">
                    <div class="col-md-4 form-group">
                        <label for="title">Name</label>
                        <input type="text" class="form-control" name="name" v-model="filters.name" placeholder="Player Name" autocomplete="off" />
                        <input style="border:none; outline:none" readonly type="text" name="" id="">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="status">Position</label>
                        <select name="status" class="form-control" v-model="filters.position_id">
                            <option value="">All</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 form-group mt-4">
                        <button type="button" class="btn btn-info mt-1" @click="load">
                            <i class="fas fa-fw fa-search"></i> search
                        </button>
                    </div>
                </div>
            </div>
            {{-- 一覧表示 --}}
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#register" @click="register = {}">
                        <i class="fas fa-fw fa-plus"></i> Add Player
                    </button>
                </div>

                <template v-if="success">
                    <div v-if="!response.data.length" class="card-body p-0">
                        <p class="p-3">NO PLAYER</p>
                    </div>
                    <template v-else>
                        <div class="card-body p-0 table-responsive">
                            <table class="table table-striped table-sm">
                                <thead class="small">
                                    <tr>
                                        <th>NAME</th>
                                        <th>EMAIL</th>
                                        <th>PHONE</th>
                                        <th>AGE</th>
                                        <th>POSITION</th>
                                        <th>PERMISSION</th>
                                        <th>IMAGE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="row in response.data" :key="row.id">
                                        <template v-if="row.edit_mode">
                                            <td>
                                                <input type="text" class="form-control d-inline" name="name" v-model="row.name" :class="{ 'is-invalid': errors.name }" />
                                                <div v-if="errors.name" class="error invalid-feedback mb-2" style="display: block;">@{{ errors.name }}</div>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control d-inline" name="email" v-model="row.email" :class="{ 'is-invalid': errors.email }" />
                                                <div v-if="errors.name" class="error invalid-feedback mb-2" style="display: block;">@{{ errors.email }}</div>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control d-inline" name="phone" v-model="row.phone" :class="{ 'is-invalid': errors.phone }" />
                                                <div v-if="errors.name" class="error invalid-feedback mb-2" style="display: block;">@{{ errors.phone }}</div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control d-inline" name="age" v-model="row.age" :class="{ 'is-invalid': errors.age }" onfocus="(this.type='date')" placeholder="Date of birth" />
                                                    <div v-if="errors.age" class="error invalid-feedback mb-2" style="display: block;">@{{ errors.age }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select name="position" class="form-control" v-model="row.position_id" :class="{ 'is-invalid': errors.position }">
                                                        @foreach ($positions as $position)
                                                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div v-if="errors.position" class="error invalid-feedback mb-2" style="display: block;">@{{ errors.position }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select name="permission" class="form-control" v-model="permission_id" :class="{ 'is-invalid': errors.permission }">
                                                        @foreach ($permissions as $permission)
                                                            <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div v-if="errors.permission" class="error invalid-feedback mb-2" style="display: block;">@{{ errors.permission }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control d-inline" name="image" v-model="row.img_url" :class="{ 'is-invalid': errors.img_url }" />
                                                <div v-if="errors.img_url" class="error invalid-feedback mb-2" style="display: block;">@{{ errors.img_url }}</div>
                                            </td>
                                            <td class="text-nowrap align-middle pl-3">
                                                <button class="btn btn-default btn-sm mr-2 d-inline" @click="save(row)">
                                                    <i class="fas fa-fw fa-save"></i>保存
                                                </button>
                                                <button class="btn btn-default btn-sm d-inline" @click="cancel(row)">
                                                    <i class="fas fa-fw fa-times"></i> キャンセル
                                                </button>
                                            </td>
                                        </template>

                                        <template v-else>
                                            <td>@{{ row.name }}</td>
                                            <td>@{{ row.email }}</td>
                                            <td>@{{ row.phone }}</td>
                                            <td>@{{ calculateAge(row.age) }}</td>
                                            <td>@{{ row.position }}</td>
                                            <td>@{{ row.permissions[0]?.name }}</td>
                                            <td><img :src="row.img_url" class="img-thumbnail rounded" alt="user image" style="height:30px; width:30px"></td>
                                            <td class="text-nowrap">
                                                <button :disabled="editMode" type="button" class="btn btn-info btn-sm mr-2" @click="edit(row)">
                                                    <i class="fas fa-fw fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm mr-2" @click="remove(row.id)">
                                                    <i class="fas fa-fw fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </template>

                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- ページネーション --}}
                         <div class="card-footer small">
                            <pagination :data="response" @click-page-link="clickPageLink"></pagination>
                        </div>
                    </template>
                </template>

                <!-- ページ登録 -->
                <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="register"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h5 class="modal-title text-end">ADD PLAYER</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="text" class="form-control d-inline" name="name" v-model="register.name" :class="{ 'is-invalid': errors.name }" placeholder="User Name" />
                                    <div v-if="errors.name" class="error invalid-feedback mb-2" style="display: block;">@{{ errors.name }}</div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control d-inline" name="email" v-model="register.email" :class="{ 'is-invalid': errors.email }" placeholder="Email" />
                                    <div v-if="errors.email" class="error invalid-feedback mb-2" style="display: block;">@{{ errors.email }}</div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control d-inline" name="age" v-model="register.age" :class="{ 'is-invalid': errors.age }" onfocus="(this.type='date')" placeholder="Date of birth" />
                                    <div v-if="errors.age" class="error invalid-feedback mb-2" style="display: block;">@{{ errors.age }}</div>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control d-inline" name="phone" v-model="register.phone" :class="{ 'is-invalid': errors.phone }" placeholder="Phone" />
                                    <div v-if="errors.phone" class="error invalid-feedback mb-2" style="display: block;">@{{ errors.phone }}</div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control d-inline" name="outline" v-model="register.img_url" :class="{ 'is-invalid': errors.image }" placeholder="Image URL" />
                                    <div v-if="errors.image" class="error invalid-feedback mb-2" style="display: block;">@{{ errors.image }}</div>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control d-inline" name="password" v-model="register.password" :class="{ 'is-invalid': errors.password }" placeholder="Password" />
                                    <div v-if="errors.password" class="error invalid-feedback mb-2" style="display: block;">@{{ errors.password }}</div>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control d-inline" name="verify-password" v-model="register.verify_password" :class="{ 'is-invalid': errors.verify_password }" placeholder="Confirm Password" />
                                    <div v-if="errors.verify_password" class="error invalid-feedback mb-2" style="display: block;">@{{ errors.verify_password }}</div>
                                </div>
                                <div class="form-group">
                                    <select name="position" class="form-control" v-model="position_id" :class="{ 'is-invalid': errors.position }">
                                        <option value="0">Select Position</option>
                                        @foreach ($positions as $position)
                                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                                        @endforeach
                                    </select>
                                    <div v-if="errors.position" class="error invalid-feedback mb-2" style="display: block;">@{{ errors.position }}</div>
                                </div>
                                <div class="form-group">
                                    <select name="permission" class="form-control" v-model="permission_id" :class="{ 'is-invalid': errors.permission }">
                                        <option value="">Select Permission</option>
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                        @endforeach
                                    </select>
                                    <div v-if="errors.permission" class="error invalid-feedback mb-2" style="display: block;">@{{ errors.permission }}</div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
                                <button type="button" class="btn btn-primary" @click="add">追加</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('js/admin/player/index.js') . '?' . md5_file('js/admin/player/index.js') }}"></script>
@stop

