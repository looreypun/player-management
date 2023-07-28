<!-- adminlte::pageを継承 -->
@extends('adminlte::page')

@section('title', 'Position')

@section('content_header')
    <h1>POSITION</h1>
@stop

@section('content')
    <div id="position-index" v-cloak>
        {{-- メッセージ --}}
        <div v-if="showAlert" v-bind:class="'alert-'+alertType" class="alert alert-dismissible card sticky-top">
            <button type="button" class="close" data-dismiss="alert" @click="toggleAlert('', 'dismiss')" aria-hidden="true">×</button>
            @{{ message }}
        </div>

        <div class="p-0">
            {{-- 一覧表示 --}}
            <div class="card">
                <div class="card-header">
                    <button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#register" @click="register = {}">
                        <i class="fas fa-fw fa-plus"></i> Add Position
                    </button>
                </div>

                <template v-if="success">
                    <div v-if="!response.length" class="card-body p-0">
                        <p class="p-3">NO POSITION</p>
                    </div>
                    <template v-else>
                        <div class="card-body p-0 table-responsive">
                            <table class="table table-striped table-sm">
                                <thead class="small">
                                <tr>
                                    <th>ID</th>
                                    <th>POSITION</th>
                                    <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="row in response" :key="row.id">
                                    <template v-if="row.edit_mode">
                                        <td>@{{ row.id }}</td>
                                        <td>
                                            <input type="text" class="form-control d-inline" name="name" v-model="row.name" :class="{ 'is-invalid': errors.name }" placeholder="Position name" />
                                            <div v-if="errors.name" class="error invalid-feedback mb-2" style="display: block;">@{{ errors.name }}</div>
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
                                        <td>@{{ row.id }}</td>
                                        <td>@{{ row.name }}</td>
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
                    </template>
                </template>

                <!-- ページ登録 -->
                <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="register"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                                <h5 class="modal-title text-end">ADD POSITION</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="text" class="form-control d-inline" name="position" v-model="position" :class="{ 'is-invalid': errors.position }" placeholder="Position Name" />
                                    <div v-if="errors.position" class="error invalid-feedback mb-2" style="display: block;">@{{ errors.position }}</div>
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
    <script src="{{ asset('js/admin/position/index.js') . '?' . md5_file('js/admin/position/index.js') }}"></script>
@stop

