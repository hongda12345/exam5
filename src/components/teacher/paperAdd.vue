<template>
    <div>
        <el-form ref="form" :model="form" label-width="80px" :rules="rules">
            <el-form-item label="试卷名称" prop="pname">
                <el-input  type="text" v-model="form.pname"></el-input>
            </el-form-item>
            <el-form-item label="班级名称">
                <el-select v-model="form.cid" placeholder="请选择班级">
                    <el-option v-for="val in options" :value="val.cid" :label="val.cname" :key="val.cid"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="出题人" prop="author">
                <el-input  type="text" v-model="form.author"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="submitForm('form')">提交</el-button>
            </el-form-item>
        </el-form>
        <!--<el-table :data="tableData" style="width: 100%" height="365">
            <el-table-column type="selection"></el-table-column>
            <el-table-column label="序号" prop="id"></el-table-column>
            <el-table-column label="试题号" prop="tid"></el-table-column>
            <el-table-column label="试卷类型" prop="pid"></el-table-column>
            <el-table-column label="操作">
                <template slot-scope="scope">
                    <router-link :to="{name:'paperExtraUpdate',query:{id:scope.row.id}}">修改</router-link>
                    <el-button @click="del(scope.row.id)" type="text">删除</el-button>
                </template>
            </el-table-column>
        </el-table>
        <div style="margin-top: 20px">
            <el-button @click="reverSelection()">反选</el-button>
            <el-button @click="cancel()">取消选择</el-button>
            <el-button @click="del()">删除</el-button>
        </div>-->
    </div>
</template>
<script>
    export default{
        name:'testAdd',
        data:function () {
            return{
                id:'',
                pid:'',
                form: {
                    pid:'',
                    cid:'',
                    tid:'',
                    type:'',
                    pname: '',
                    author:'',

                },
                options:[],
                tableData:[],
                multipleSelection: [],
                rules: {

                }
            }
        },
        methods: {
            /*///////反选/////////
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
            //////////删除选中的//////////*/
            /*del(){
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
            },*/
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$http.post('/home/paperAdd.php',this.form).then(res=>{
                            if(res.body=='ok'){
                                this.$message({
                                    message:'恭喜你，添加成功',
                                    type:"success"
                                })
                                this.$router.push('managePaper')
                            }else if(res.body=='error'){
                                this.$message({
                                    message:'对不起，添加失败',
                                    type:"error"
                                })
                            }
                        })
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            }
        },
        mounted(){
            /*this.id=this.$route.query.id;
            this.$http.get('/home/managePaperExtra.php?id='+this.id).then(res=>{
                this.tableData=res.body
            })*/
            this.$http.get('/home/manageClass.php').then(res=>{
                this.options = res.body
            })
        }
    }
</script>
<style>

</style>