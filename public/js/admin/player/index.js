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
              outline: row.outline,
              require_login_flg: row.require_login_flg,
          };
          row.edit_mode = true;
          this.editMode = true;
          console.log(row);
      },
      // add player
      add() {
          this.errors = {};
          this.filters = {};

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

          axios.post('/admin/player', this.register)
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
      // update player info
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
        axios.put('/admin/player/' + row.id, row)
        .then(response => {
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
        axios.delete('/admin/player/' + id)
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
          row.outline = row.org.outline;
          row.require_login_flg = row.org.require_login_flg;
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
      // load player list
      load(page) {
        axios.post(`/admin/player/search?page=${page}`, this.filters)
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
}).mount('#player-index');
