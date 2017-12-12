<template>
    <div class="panel admin-panel">
        <div class="panel-head"><strong class="icon-reorder"> 内容列表 </strong></div>
        <div class="padding border-bottom">
            <a class="button border-yellow" href=""><span class="icon-plus-square-o"></span><router-link :to="{name:'teaAdd'}"> 添加内容</router-link></a>
        </div>
        <el-table ref="multipleTable" :data="tableData" tooltip-effect="dark" style="width: 100%" @selection-change="handleSelectionChange">
            <el-table-column type="selection"></el-table-column>
            <el-table-column label="序号">
                <template slot-scope="scope">{{ scope.row.tid }}</template>
            </el-table-column>
            <el-table-column prop="mname" label="教师姓名"></el-table-column>
            <el-table-column prop="tsex" label="性别"></el-table-column>
            <el-table-column prop="tnum" label="工号"></el-table-column>
            <el-table-column prop="cname" label="所在班级"></el-table-column>
            <el-table-column prop="sname" label="所学阶段"></el-table-column>
            <el-table-column prop="dname" label="所属方向"></el-table-column>
            <el-table-column label="操作">
                <template slot-scope="scope">
                    <router-link :to="{name:'teaUpdate',query:{tid:scope.row.tid}}">修改</router-link>
                </template>
            </el-table-column>
        </el-table>
        <div style="margin-top: 20px">
            <el-button @click="reverSelection()">反选</el-button>
            <el-button @click="cancel()">取消选择</el-button>
            <el-button @click="del()">删除</el-button>
        </div>
    </div>
</template>
<script>
    export default{
        name:'manageTea',
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
                let ids=this.multipleSelection.map(ele=>ele.tid);
                this.$http.post('/home/teaDelete.php',{ids}).then(res=>{
                    if(res.body=='ok'){
                        this.$message({
                            showClose: true,
                            message:'删除成功',
                            type:"success"
                        })
                        this.tableData=this.tableData.filter(ele=>!ids.includes(ele.tid));
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
            this.$http.get('/home/manageTea.php').then(res=>{
                this.tableData = res.body;
            })
        }
    }
</script>
<style>
    @import "../../assets/css/admin.css";
    @import "../../assets/css/pintuer.css";
</style>