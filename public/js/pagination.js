const pagination = {
  props: [ 'data', 'compact', 'pagerange' ],
  template: `
  <div class="clearfix">
      <div class="float-right">
          <ul class="pagination" :class="{'pagination-sm mb-0': compact}">
              <li class="page-item" :class="{disabled: data.current_page <= 1}">
                  <a class="page-link" aria-label="Previous" @click="goPage(1)">
                      <span aria-hidden="true">&laquo;</span>
                      <span class="sr-only">Previous</span>
                  </a>
              </li>
              <li class="page-item" :class="{disabled: data.current_page <= 1}"><a class="page-link" @click="goPage(data.current_page - 1)">&lt;</a></li>
              <li class="page-item" v-for="page in pages" :key="page" :class="{active: page === data.current_page}">
                  <a class="page-link" @click="goPage(page)">{{page}}</a>
              </li>
              <li class="page-item" :class="{disabled: data.current_page >= data.last_page}"><a class="page-link" @click="goPage(data.current_page + 1)">&gt;</a></li>
              <li class="page-item" :class="{disabled: data.current_page >= data.last_page}">
                  <a class="page-link" aria-label="Next" @click="goPage(data.last_page)">
                      <span aria-hidden="true">&raquo;</span>
                      <span class="sr-only">Next</span>
                  </a>
              </li>
          </ul>
      </div>
  </div>
  <div v-if="!compact" class="float-right">
      <p>{{data.total}} 件中 {{data.from}} 〜 {{data.to}} 件表示</p>
  </div>
  `,
  methods: {
      goPage(page) {
          this.$emit('click-page-link', page);
      }
  },
  computed: {
      pages() {
          if (this.data) {
              const pageRange = this.pagerange || 5;
              let pagenation = this.data;
              let start = _.max([pagenation.current_page - Math.floor(pageRange / 2), 1]);
              let end = _.min([start + pageRange, pagenation.last_page + 1]);
              start = _.max([end - pageRange, 1]);
              return _.range(start, end);
          }
      }
  },
}
