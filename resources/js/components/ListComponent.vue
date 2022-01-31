<template>
    <div class="col-md-4 p-0">
        <div class="card h-100">
            <!-- <div class="card-header d-flex">メモ一覧 <a class='ml-auto' href='/create'><i class="fas fa-plus-circle"></i></a></div> -->
            <div class="card-body p-2 px-4">
                    <p v-for="(memo, index) in memos" :key="index">{{ memo.content }}</p>
            </div>
        </div>
    </div>
</template>

 <script>
    export default {
        data: function () {
            return {
                memos: []
            }
        },
        methods: {
            getMemos() {
                axios.get('/api/memos')
                    .then((res) => {
                        this.memos = res.data;
                    });
            }

            // deleteMemo(id) {
            //     axios.delete('/api/memos/' + id)
            //         .then((res) => {
            //             this.getMemos();
            //     });
            // }

        },
        mounted() {
            this.getMemos();
        }
    }
 </script>
