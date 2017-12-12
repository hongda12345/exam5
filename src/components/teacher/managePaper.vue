<template>
    <div>
        <div class="panel admin-panel">
            <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong></div>
            <div class="padding border-bottom">
                <a class="button border-yellow"><span class="icon-plus-square-o"></span><router-link :to="{name:'paperAdd'}"> 添加内容</router-link></a>
            </div>
            <el-table ref="multipleTable" :data="tableData" tooltip-effect="dark" style="width: 100%" @selection-change="handleSelectionChange">
                <el-table-column type="selection"></el-table-column>
                <el-table-column label="编号" prop="pid"></el-table-column>
                <el-table-column label="试卷名称" prop="pname"></el-table-column>
                <el-table-column label="班级名称" prop="cname"></el-table-column>
                <el-table-column label="出题人" prop="author"></el-table-column>
                <el-table-column label="操作">
                    <template slot-scope="scope">
                        <router-link :to="{name:'paperUpdate',query:{pid:scope.row.pid}}">编辑</router-link>
                    </template>
                </el-table-column>
            </el-table>
            <div style="margin-top: 20px">
                <el-button @click="reverSelection()">反选</el-button>
                <el-button @click="cancel()">取消选择</el-button>
                <el-button @click="del()">删除</el-button>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        name:'managePaper',
        data() {
            return {
                tableData: [],
                multipleSelection: []
            }
        },
        methods:{
            ///////反选/////////
            reverSelection() {
                this.tableData.forEach(row => {
                    this.$refs.multipleTable.toggleRowSelection(row);
                });
            },
            ///////取消选择///////
            cancel(){
                this.$refs.multipleTable.clearSelection();
            },
            //////////多选//////////
            handleSelectionChange(val) {
                this.multipleSelection = val;
            },
            //////////删除选中的//////////
            del(){
                let ids=this.multipleSelection.map(ele=>ele.pid);
                this.$http.post('/home/paperDelete.php',{ids}).then(res=>{
                    if(res.body=='ok'){
                        this.$message({
                            showClose: true,
                            message:'删除成功',
                            type:"success"
                        })
                        this.tableData=this.tableData.filter(ele=>!ids.includes(ele.pid));
                    }else if(res.body=='error'){
                        this.$message({
                            showClose: true,
                            message:'删除失败',
                            type:"warning"
                        })
                    }
                })
            }
        },
        mounted(){
            this.$http.get('/home/managePaper.php').then(res=>{
                this.tableData = res.body;
            })
        }
    }
</script>
<style>
    @import "../../assets/css/admin.css";
    @import "../../assets/css/pintuer.css";
</style>