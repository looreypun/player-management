Vue.createApp({
    data() {
        return {
            success: false,
            editMode: false,
            showAlert: false,
            message: '',
            alertType: 'info',
            permission: '',
            errors: {},
            response: {}
        };
    },
    methods: {
        // show edit form
        edit(row) {
            row.org = {
                name: row.name,
            };
            row.edit_mode = true;
            this.editMode = true;
        },
        // add permission
        add() {
            this.errors = {};

            if (!this.permission) {
                this.errors.permission = 'Enter permission name';
                return;
            }

            axios.post('/admin/permission', { name: this.permission })
                .then(response => {
                    this.toggleAlert(response.data.message);
                    this.load();
                    $('#register').modal('hide');
                })
                .catch(error => {
                    console.warn(error);
                    this.toggleAlert('Failed to add  permission', 'error');
                });
        },
        // update permission info
        save(row) {
            this.errors = {};
            if (!row.name) {
                this.errors.name = 'Enter permission name';
                return;
            }
            axios.put('/admin/permission/' + row.id, row)
                .then(response => {
                    this.toggleAlert(response.data.message);
                    row.edit_mode = false;
                    this.editMode = false;
                    this.load();
                })
                .catch(error => {
                    console.warn(error);
                    this.toggleAlert('Failed to update permission', 'error');
                });
        },
        // delete user info
        remove(id) {
            if (!confirm('Are you sure you want to delete permission?')) {
                return;
            }
            axios.delete('/admin/permission/' + id)
                .then(response => {
                    this.toggleAlert(response.data.message);
                    this.load();
                })
                .catch(error => {
                    console.warn(error);
                    this.toggleAlert('Failed to delete permission', 'error');
                });
        },
        // cancel edit
        cancel(row) {
            row.name = row.org.name;
            row.edit_mode = false;
            this.editMode = false;
            this.errors = {};
        },
        // toggle alert message
        toggleAlert(msg, type = 'info') {
            this.message = msg;
            this.alertType = type === 'error' ? 'danger' : 'info';
            this.showAlert = true;

            if (type === 'dismiss') {
                this.showAlert = false;
            }

            if (type === 'info') {
                setTimeout(() => {
                    this.showAlert = false;
                }, 3000);
            }
        },
        // load permission list
        load() {
            axios.post(`/admin/permission/list`)
                .then(response => {
                    this.response = response.data;
                    console.log(this.response);
                    console.log(this.response.length);
                    this.success = true;
                    this.editMode = false;
                })
                .catch(error => {
                    console.error(error);
                });
        },
    },
    mounted() {
        this.load();
    },
}).mount('#permission-index');
