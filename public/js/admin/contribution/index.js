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
            filters: {},
            register: {},
            errors: {},
            response: {}
        };
    },
    methods: {
        // show edit form
        edit(row) {
            row.org = {
                name: row.name,
                amount: row.amount,
                memo: row.memo
            };
            row.edit_mode = true;
            this.editMode = true;
        },
        // add position
        add() {
            this.errors = {};

            if (!this.register.name) {
                this.errors.name = 'Enter User name';
                return;
            } if (!this.register.amount) {
                this.errors.amount = 'Enter Amount';
                return;
            }

            axios.post(baseUrl + '/admin/contribution', this.register)
                .then(response => {
                    this.register = {};
                    this.toggleAlert(response.data.message);
                    this.load();
                    $('#register').modal('hide');
                })
                .catch(error => {
                    console.warn(error);
                    this.toggleAlert('Failed to add  data', 'error');
                });
        },
        // update position info
        save(row) {
            this.errors = {};

            if (!row.name) {
                this.errors.name = 'Enter User name';
                return;
            }

            if (!row.amount) {
                this.errors.amount = 'Enter Amount';
                return;
            }

            axios.put(baseUrl + '/admin/contribution/' + row.id, row)
                .then(response => {
                    this.toggleAlert(response.data.message);
                    row.edit_mode = false;
                    this.editMode = false;
                    this.load();
                })
                .catch(error => {
                    console.warn(error);
                    this.toggleAlert('Failed to update data', 'error');
                });
        },
        // delete user info
        remove(id) {
            if (!confirm('Are you sure you want to delete data?')) {
                return;
            }
            axios.delete(baseUrl + '/admin/contribution/' + id)
                .then(response => {
                    this.toggleAlert(response.data.message);
                    this.load();
                })
                .catch(error => {
                    console.warn(error);
                    this.toggleAlert('Failed to delete data', 'error');
                });
        },
        // cancel edit
        cancel(row) {
            row.name = row.org.name;
            row.amount = row.org.amount;
            row.memo = row.org.memo;
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
        clickPageLink(page) {
            this.load(page);
        },
        // load position list
        load(page) {
            axios.post(baseUrl + `/admin/contribution/search?page=${page}`, this.filters)
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
}).mount('#contribution-index');
