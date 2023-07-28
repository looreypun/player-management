Vue.createApp({
    data() {
        return {
            success: false,
            editMode: false,
            showAlert: false,
            message: '',
            alertType: 'info',
            position: '',
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
        // add position
        add() {
            this.errors = {};

            if (!this.position) {
                this.errors.position = 'Enter position name';
                return;
            }

            axios.post('/admin/position', { name: this.position })
                .then(response => {
                    this.toggleAlert(response.data.message);
                    this.load();
                    $('#register').modal('hide');
                })
                .catch(error => {
                    console.warn(error);
                    this.toggleAlert('Failed to add  user', 'error');
                });
        },
        // update position info
        save(row) {
            this.errors = {};
            if (!row.name) {
                this.errors.name = 'Enter position name';
                return;
            }
            axios.put('/admin/position/' + row.id, row)
                .then(response => {
                    this.toggleAlert(response.data.message);
                    row.edit_mode = false;
                    this.editMode = false;
                    this.load();
                })
                .catch(error => {
                    console.warn(error);
                    this.toggleAlert('Failed to update user', 'error');
                });
        },
        // delete user info
        remove(id) {
            if (!confirm('Are you sure you want to delete position?')) {
                return;
            }
            axios.delete('/admin/position/' + id)
                .then(response => {
                    this.toggleAlert(response.data.message);
                    this.load();
                })
                .catch(error => {
                    console.warn(error);
                    this.toggleAlert('Failed to delete position', 'error');
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
        // load position list
        load() {
            axios.post(`/admin/position/list`)
                .then(response => {
                    this.response = response.data;
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
}).mount('#position-index');
