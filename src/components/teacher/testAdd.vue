<template>
    <div>
        <el-form ref="form" :model="form" label-width="80px" :rules="rules">
            <el-form-item label="阶段">
                <el-select v-model="form.sid" placeholder="请选择阶段">
                    <el-option v-for="val in stage" :value="val.sid" :label="val.sname" :key="val.sid"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="题型">
                <el-select v-model="form.type" placeholder="请选择题型">
                    <el-option v-for="val in types" :value="val.tid" :label="val.tname" :key="val.tid"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="题目" prop="title">
                <el-input type="textarea" v-model="form.title"></el-input>
            </el-form-item>
            <el-form-item label="解析" prop="exp">
                <el-input type="textarea" v-model="form.exp"></el-input>
            </el-form-item>
            <el-form-item label="答案" prop="answer">
                <el-input type="textarea" v-model="form.answer"></el-input>
            </el-form-item>
            <el-form-item label="分值" prop="score">
                <el-input  type="text" v-model="form.score"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="submitForm('form')">提交</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>
<script>
    export default{
        name:'addTest',
        data() {
            return {
                stage:[],
                types:[],
                form: {
                    sid: '',
                    type:'',
                    title:'',
                    exp:'',
                    answer:'',
                    score:''

                },
                rules: {
//                    tname: [
//                        { required: true, message: '请输入题型名称', trigger: 'blur' },
//                        { min: 1, max: 10, message: '长度在 1 到 10 个字符', trigger: 'blur' }
//                    ],
                }
            }
        },
        methods: {
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        this.$http.post('/home/testAdd.php',this.form).then(res=>{
                            if(res.body=='ok'){
                                this.$message({
                                    message:'恭喜你，添加成功',
                                    type:"success"
                                })
                                this.$router.push('manageTest');
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
            this.$http.get('/home/manageStage.php').then(res=>{
                this.stage = res.body
            })
            this.$http.get('/home/manageType.php').then(res=>{
                this.types = res.body
            })
        }
    }
</script>
<style>

</style>