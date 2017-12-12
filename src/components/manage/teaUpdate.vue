<template>
    <div>
        <el-form ref="form" :model="form" label-width="80px" :rules="rules">
            <el-form-item label="ID">
                {{form.tid}}
            </el-form-item>
            <el-form-item label="教师姓名" prop="mname">
                <el-input  type="text" v-model="form.mname"></el-input>
            </el-form-item>
            <el-form-item label="性别">
                <el-radio-group v-model="form.tsex">
                    <el-radio label="男">男</el-radio>
                    <el-radio label="女">女</el-radio>
                </el-radio-group>
            </el-form-item>
            <el-form-item label="教师工号" prop="tnum">
                <el-input  type="text" v-model="form.tnum"></el-input>
            </el-form-item>
            <el-form-item label="所在班级">
                <el-select v-model="form.cid" placeholder="请选择所在班级">
                    <el-option v-for="val in classes" :value="val.cid" :label="val.cname" :key="val.cid"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="所学阶段">
                <el-select v-model="form.sid" placeholder="请选择所学阶段">
                    <el-option v-for="val in stage" :value="val.sid" :label="val.sname" :key="val.sid"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="所属方向">
                <el-select v-model="form.did" placeholder="请选择所属方向">
                    <el-option v-for="val in direction" :value="val.did" :label="val.dname" :key="val.did"></el-option>
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
        name:'teaUpdate',
        data:function () {
            return{
                tid:'',
                direction:[],
                stage:[],
                classes:[],
                form:{
                    tid:'',
                    mname:'',
                    tsex:'',
                    tnum:'',
                    /*dname:'',
                    sname:'',
                    cname:'',*/
                },
                rules: {
                    tname: [
                        { required: true, message: '请输入教师姓名', trigger: 'blur' },
                        { min: 1, max: 20, message: '长度在 1 到 20 个字符', trigger: 'blur' }
                    ],
                    tnum: [
                        { required: true, message: '请输入教师工号', trigger: 'blur' },
                        { min: 1, max: 11, message: '长度在 1 到 11 个字符', trigger: 'blur' }
                    ]
                }
            }
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$http.post('/home/teaUpdate.php',this.form).then(res=>{
                            if(res.body=='ok'){
                                this.$message({
                                    message:'恭喜你，修改成功',
                                    type:"success"
                                })
                                this.$router.push('manageTea')
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
            this.tid=this.$route.query.tid;
            this.$http.get('/home/teaQuery.php?tid='+this.tid).then(res=>{
                this.form=res.body
            })
            this.$http.get('/home/manageDir.php').then(res=>{
                this.direction = res.body
            })
            this.$http.get('/home/manageStage.php').then(res=>{
                this.stage = res.body
            })
            this.$http.get('/home/manageClass.php').then(res=>{
                this.classes = res.body
            })
        }
    }
</script>
<style>

</style>