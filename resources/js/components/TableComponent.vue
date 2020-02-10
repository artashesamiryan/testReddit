<template>
    <div class="container-fluid">
        <div class="table-responsive">
            <div class="col-12">
                <button type="button" class="btn btn-outline-info btn-icon-text mt-2 mb-2 mr-3 float-right"
                    @click="revert"><i class="mdi mdi-reload btn-icon-prepend"></i>Refresh</button>
                <a type="button" class="btn btn-outline-info btn-icon-text mt-2 mb-2 mr-3 float-right" href="/posts/reddit"><i class="mdi mdi-login btn-icon-prepend"></i>Get Reddit Posts</a>
            </div>
            <table :class="(opacity == true) ? 'table op-05' : 'table'" v-if="posts">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Headline</th>
                        <th>Content</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(post, index) in posts" :key="index" v-bind:id="post.id" class="tr-hoverable">
                        <td>{{post.user ? post.user[0] ? post.user[0].username : '' : ''}}</td>
                        <td>{{post.headline || ''}}</td>
                        <td>{{post.content || ''}}</td>
                        <td>
                            <div class="text-danger hover-cursor float-left mr-1"><i class="mdi mdi-delete"
                                    @click="deleteItem(post, index)"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="paginate-block">
                <div class="total-block" v-if="posts && posts.length">
                    <div class="dataTables_info" id="order-listing_info" role="status" aria-live="polite">Showing {{to}}
                        of {{totalRows}} entries</div>
                </div>
                <div class="paginate-items">
                    <div class="f-r">
                        <b-pagination size="md" align="center" :total-rows="totalRows" v-model="currentPage"
                            :per-page="perPage" @change="getTable" :disabled="opacity" v-show="totalRows > perPage">
                        </b-pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { BPagination } from 'bootstrap-vue';
    const moment = require("moment");
    export default {
        name: 'TableComponent',
        components: {
            BPagination
        },
        data() {
            return {
                currentPage: 1,
                perPage: 20,
                page: 1,
                totalRows: 100,
                opacity: true,
                to: 1,
                posts: []
            }
        },
        created() {
            this.getTable();
        },
        methods: {
            getTable() {
                $.post('/table', {
                    perPage: this.perPage,
                    page: this.currentPage,
                }, resolve => {
                    this.posts = resolve.posts.data;
                    this.page = this.currentPage;
                    this.totalRows = resolve.posts.total;
                    this.to = resolve.posts.to;
                    this.opacity = false;
                });
            },
            deleteItem(post, index) {
                if (confirm(`Are you sure you want delete ${post.headline}`)) {
                    $.post("/table/delete", { id: post.id }, resolve => {
                        this.indexItem(index, 'delete');
                    });
                }
            },
            indexItem(index) {
                this.posts.splice(index, 1);
                this.totalRows = this.totalRows - 1;
                this.to = this.to - 1;
            },
            dateFormat(date) {
                return moment(date).format('ll');
            },
            revert() {
                this.posts = [];
                this.currentPage = 1;
                this.totalRows = 1;
                this.to = 1;
                this.getTable();
            },
        }

    }
</script>
<style>
    .hover-cursor {
        cursor: pointer;
    }
</style>