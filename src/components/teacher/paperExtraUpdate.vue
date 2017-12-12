<template>
    <div>
        <el-form ref="form" :model="form" label-width="80px" :rules="rules">
            <el-form-item label="ID">{{form.pid}}</el-form-item>
            <el-form-item label="试卷名称" prop="pname">
                <el-input  type="text" v-model="form.pname"></el-input>
            </el-form-item>
            <el-form-item label="班级名称">
                <el-select v-model="form.cid" placeholder="请选择班级">
                    <el-option v-for="val in options" :value="val.cid" :label="val.cname" :key="val.cid"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="submitForm('form')">提交</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>
<script>
    export default{
        name:'testUpdate',
        data:function () {
            return{
                pid:'',
                form: {
                    pid:'',
                    cid:'',
                    pname: '',

                },
                options:[],
                rules: {

                }
            }
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$http.post('/home/paperUpdate.php',this.form).then(res=>{
                            if(res.body=='ok'){
                                this.$message({
                                    message:'恭喜你，修改成功',
                                    type:"success"
                                })
                                this.$router.push('managePaper')
                            }else if(res.body=='error'){
                                this.$message({
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
            this.pid=this.$route.query.pid;
            this.$http.get('/home/paperQuery.php?pid='+this.pid).then(res=>{
                this.form=res.body
            })
            this.$http.get('/home/manageClass.php').then(res=>{
                this.options = res.body
            })
        }
    }
</script>
<style>

</style>