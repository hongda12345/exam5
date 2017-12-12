<template>
    <div>
        <div class="panel admin-panel">
            <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong></div>
            <div class="padding border-bottom">
                <a class="button border-yellow" href=""><span class="icon-plus-square-o"></span><router-link :to="{name:'classAdd'}"> 添加内容</router-link></a>
            </div>
            <el-table
                    :data="tableData"
                    stripe
                    style="width: 100%">
                <el-table-column
                        prop="cid"
                        label="ID"
                        width="180">
                </el-table-column>
                <el-table-column
                        prop="cname"
                        label="班级名称"
                        width="180">
                </el-table-column>
                <el-table-column
                        prop="dname"
                        label="方向名称"
                        width="180">
                </el-table-column>
                <el-table-column label="操作">
                    <template slot-scope="scope">
                        <el-button size="mini">
                            <router-link :to="{name:'classUpdate',query:{cid:scope.row.cid}}">修改</router-link>
                        </el-button>
                        <el-button
                                size="mini"
                                type="danger"
                                @click="del(scope.row.cid)">删除
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
        </div>
    </div>
</template>
<script>
    export default {
        name:'manageClass',
        data() {
            return {
                tableData: [

                ]
            }
        },
        methods:{
            del(cid){
                this.$http.post('/home/classDelete.php',{cid}).then(res=>{
                    if(res.body =='ok'){
                        this.tableData =  this.tableData.filter(ele=>ele.cid != cid);
                    }else if(res.body =='error'){
                        this.$message({
                            showClose: true,
                            message: '删除失败',
                            type: 'error'
                        });
                    }
                })
            }
        },
        mounted(){
            this.$http.post('/home/manageClass.php').then(res=>{
                this.tableData=res.body;
            });
        }
    }
</script>
<style>

</style>