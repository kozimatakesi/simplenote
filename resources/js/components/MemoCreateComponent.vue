<template>
    <div class="row justify-content-center ml-0 mr-0 h-100">
        <div class="card w-100">
            <div class="card-header">新規メモ作成</div>
            <div class="card-body">
                <form v-on:submit.prevent="submit">
                    <div class="form-group">
                        <textarea id='content' class="form-control" rows="10" v-model="memo.content"></textarea>
                    </div>

                    <!-- <div class="form-group">
                        <label for="tag">タグ</label>
                        <input name='tag' type="text" class="form-control" id="tag" placeholder="タグを入力">
                    </div> -->

                    <button type='submit' class="btn btn-primary btn-lg">保存</button>
                </form>
            </div>
        </div>
    </div>
</template>

 <script>
    export default {
        data: function () {
            return {
                memo: {}
            }
        },
        methods: {
            submit() {
                axios.post('/api/memos', this.memo)
                    .then((res) => {
                        console.log('success');
                        this.$router.push({name: 'memo.list'});
                    });
            }
        }
    }
 </script>
