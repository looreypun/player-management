Vue.createApp({
    components: {
        pagination: pagination,
    },
    data() {
        return {
            success: false,
            editMode: false,
            showAlert: false,
            message: '',
            alertType: 'info',
            filters: {
                position_id: ''
            },
            register: {},
            position_id: 0,
            permission_id: '',
            errors: {},
            response: {}
        };
    },
    methods: {
        // show edit form
        edit(row) {
            row.org = {
                name: row.name,
                email: row.email,
                phone: row.phone,
                age: row.age,
                position: row.position,
                img_url: row.img_url
            };
            row.edit_mode = true;
            this.editMode = true;
            this.permission_id = row.permissions[0]?.name;
            console.log(row);
        },
        // add member
        add() {
            this.errors = {};

            if (!this.register.name) {
                this.errors.name = 'Enter name';
                return;
            }
            if (!this.register.email) {
                this.errors.email = 'Enter email';
                return;
            }
            if (!this.register.password) {
                this.errors.password = 'Enter password';
                return;
            }
            if (!this.register.verify_password) {
                this.errors.verify_password = 'Confirm password';
                return;
            }
            if (this.register.password !== this.register.verify_password) {
                this.errors.verify_password = 'Password did not match';
                return;
            }

            if (!this.permission_id) {
                this.errors.permission = 'Select permission';
                return;
            }

            this.register.permission_id = this.permission_id;
            this.register.position_id = this.position_id;

            axios.post('/admin/member', this.register)
                .then(response => {
                    this.register = {};
                    this.permission_id = 0;
                    this.position_id = 0;
                    this.toggleAlert(response.data.message);
                    this.load();
                    $('#register').modal('hide');
                })
                .catch(error => {
                    console.warn(error);
                    this.toggleAlert('Failed to add  user', 'error');
                });
        },
        // update member info
        save(row) {
            this.errors = {};
            if (!row.name) {
                this.errors.name = 'Enter name';
                return;
            }
            if (!row.email) {
                this.errors.email = 'Enter email';
                return;
            }
            if (!this.permission_id) {
                this.errors.permission = 'Select permission';
                return;
            }
            row.permission_id = this.permission_id;
            axios.put('/admin/member/' + row.id, row)
                .then(response => {
                    this.permission_id = 0;
                    this.toggleAlert(response.data.message);
                    row.edit_mode = false;
                    this.editMode = false;
                    this.load(this.response.current_page);
                })
                .catch(error => {
                    console.warn(error);
                    this.toggleAlert('Failed to update user', 'error');
                });
        },
        // delete user info
        remove(id) {
            if (!confirm('Are you sure you want to delete user?')) {
                return;
            }
            axios.delete('/admin/member/' + id)
                .then(response => {
                    this.toggleAlert(response.data.message);
                    this.load(this.response.current_page);
                })
                .catch(error => {
                    console.warn(error);
                    this.toggleAlert('Failed to delete user', 'error');
                });
        },
        // cancel edit
        cancel(row) {
            row.name = row.org.name,
                row.email = row.org.email,
                row.phone = row.org.phone,
                row.age = row.org.age,
                row.position = row.org.position,
                row.img_url = row.org.img_url
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
        // age calculation
        calculateAge(dob) {
            const birthYear = new Date(dob).getFullYear();
            const currentYear = new Date().getFullYear();
            const age = currentYear - birthYear;
            return age;
        },
        clickPageLink(page) {
            this.load(page);
        },
        // load member list
        load(page) {
            axios.post(`/admin/member/search?page=${page}`, this.filters)
                .then(response => {
                    console.log(response);
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
        this.load(1);
    },
}).mount('#member-index');
