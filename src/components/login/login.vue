<template>
    <div>
        <div class="bg"></div>
        <div class="container">
            <div class="line bouncein">
                <div class="xs6 xm4 xs3-move xm4-move">
                    <div style="height:150px;"></div>
                    <div class="media media-y margin-big-bottom">
                    </div>
                    <form action="index.html" method="post">
                        <div class="panel loginbox">
                            <div class="text-center margin-big padding-big-top"><h1>后台管理中心</h1></div>
                            <div class="panel-body" style="padding:30px; padding-bottom:10px; padding-top:10px;">
                                <el-form :rules="rules" ref="form" :model="form" label-width="80px">
                                    <el-form-item label="用户名" prop="name">
                                        <el-input v-model="form.name"></el-input>
                                    </el-form-item>
                                    <el-form-item label="密码" prop="pass">
                                        <el-input type="password" v-model="form.pass"></el-input>
                                    </el-form-item>
                                    <el-form-item label="类别" prop="type">
                                        <el-radio-group v-model="form.type">
                                            <el-radio label="manager">管理员</el-radio>
                                            <el-radio label="teacher">教师</el-radio>
                                            <el-radio label="student">学生</el-radio>
                                        </el-radio-group>
                                    </el-form-item>
                                    <el-form-item label="验证码" prop="code">
                                        <el-input type="text" v-model="form.code" style="float:left;width:130px;"></el-input>
                                        <img :src="src" alt="" @click="src='/home/code.php?id='+Math.random()" style="float:right;margin:5px;">
                                    </el-form-item>
                                    <el-form-item>
                                        <el-button type="primary" @click="onSubmit('form')">立即登录</el-button>
                                    </el-form-item>
                                </el-form>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'login',
        data() {
            return {
                form: {
                    name: '',
                    pass: '',
                    type: '',
                    code:'',
                },
                src:'/home/code.php',
                rules:{
                    name:[
                        { required: true, message: '请输入用户名', trigger: 'blur' },
                        { min: 3, max: 10, message: '长度在 3 到 10 个字符', trigger: 'blur' }
                    ],
                    pass:[
                        { required: true, message: '请输入密码', trigger: 'blur' },
                        { min: 3, max: 6, message: '长度在 3 到 6 个字符', trigger: 'blur' }
                    ],
                    type:[
                        { required: true, message: '请选择角色', trigger: 'blur' },
                    ],
                    code:[
                        { required: true, message: '请输入验证码', trigger: 'blur' },
                    ]
                }
            }
        },
        methods: {
            onSubmit(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$http.post('/home/checklogin.php',this.form).then(res=>{
                            if(res.body==1){
                                this.$message({
                                    showClose: true,
                                    message: '恭喜你，登陆成功',
                                    type: 'success'
                                });
                                if(this.form.type=='manager'){
                                    this.$router.push('/mangage');
                                }else if(this.form.type=='teacher'){
                                    this.$router.push('/teacher');
                                }else if(this.form.type=='student'){
                                    this.$router.push('/student/studentExam');
                                }
                            }else if(res.body==2){
                                this.$message({
                                    showClose: true,
                                    message: '密码错误！',
                                    type: 'warning'
                                });
                            }else if(res.body==3){
                                this.$message({
                                    showClose: true,
                                    message: '验证码错误！',
                                    type: 'error'
                                });
                            }else if(res.body==4){
                                this.$message({
                                    showClose: true,
                                    message: '用户名不存在！',
                                    type: 'error'
                                });
                            }
                        })
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            }
        }
    }
</script>
<style>
    @import "../../assets/css/admin.css";
    @import "../../assets/css/pintuer.css";
</style>