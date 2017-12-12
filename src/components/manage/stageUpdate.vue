<template>
    <div>
        <el-form ref="form" :model="form" label-width="80px" :rules="rules">
            <el-form-item label="ID">
                {{form.sid}}
            </el-form-item>
            <el-form-item label="所属方向">
                <el-select v-model="form.did" placeholder="请选择">
                    <el-option
                            v-for="item in options"
                            :key="item.did"
                            :label="item.dname"
                            :value="item.did">
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="阶段名称" prop="sname">
                <el-input  type="text" v-model="form.sname"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="submitForm('form')">提交</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>
<script>
    export default{
        name:'stageUpdate',
        data:function () {
            return{
                sid:'',
                value:'',
                form:{
                    sid:'',
                    sname:'',
                    value:'',
                },
                options: [
                    {

                    }
                ],
                rules: {
                    sname: [
                        { required: true, message: '请输入方向名称', trigger: 'blur' },
                        { min: 1, max: 10, message: '长度在 1 到 10 个字符', trigger: 'blur' }
                    ],
                }
            }
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$http.post('/home/stageUpdate.php',this.form).then(res=>{
                            if(res.body=='ok'){
                                this.$message({
                                    showClose: true,
                                    message:'恭喜你，修改成功',
                                    type:"success"
                                })
                                this.$router.push('manageStage');
                            }else if(res.body=='error'){
                                this.$message({
                                    showClose: true,
                                    message:'对不起，修改失败',
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
            this.sid=this.$route.query.sid;
            this.$http.get('/home/stageQuery.php?sid='+this.sid).then(res=>{
                this.form=res.body;
            })
            this.$http.get('/home/manageDir.php').then(res=>{
                this.options=res.body;
            })
        }
    }
</script>
<style>

</style>