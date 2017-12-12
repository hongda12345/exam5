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
        <el-table ref="multipleTable" :data="tableData" tooltip-effect="dark" style="width: 100%" @selection-change="handleSelectionChange">
            <el-table-column type="expand">
                <template slot-scope="props">
                    <el-form label-position="left" inline class="demo-table-expand">
                        <el-form-item label="解析">
                            <span>{{ props.row.exp }}</span>
                        </el-form-item>
                        <div v-if="props.row.options">
                            <el-form-item label="选项"></el-form-item>
                            <el-form-item v-for="item in props.row.options" :key="item.key">
                                <span>{{ item.key }}</span><span>:</span><span>{{ item.value }}</span>
                            </el-form-item>
                        </div>
                    </el-form>
                </template>
            </el-table-column>
            <el-table-column type="selection"></el-table-column>
            <el-table-column label="题号" prop="tid"></el-table-column>
            <el-table-column label="题型" prop="type"></el-table-column>
            <el-table-column label="题干" prop="title"></el-table-column>
            <el-table-column label="答案" prop="answer"></el-table-column>
            <el-table-column label="分数" prop="score"></el-table-column>
            <el-table-column label="所属阶段" prop="sname"></el-table-column>
            <el-table-column label="出题人" prop="author"></el-table-column>
            <el-table-column label="操作">
                <template slot-scope="scope">
                    <router-link :to="{name:'testUpdate',query:{tid:scope.row.tid}}">修改</router-link>
                    <el-button @click="del(scope.row.tid)" type="text">删除</el-button>
                </template>
            </el-table-column>
        </el-table>
        <div style="margin-top: 20px">
            <el-button @click="reverSelection()">反选</el-button>
            <el-button @click="cancel()">取消选择</el-button>
            <el-button @click="add()">添加</el-button>
        </div>
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
                tableDatas:[],
                options:[],
                rules: {

                }
            }
        },
        methods: {
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
            //////////添加选中的//////////
            add(){
                let ids=this.multipleSelection.map(ele=>ele.pid);
                this.$http.post('/home/managePaperExtra.php',{ids}).then(res=>{
                    if(res.body =='ok'){
                        this.$message({
                            showClose: true,
                            message:'添加成功',
                            type:"success"
                        })
                        this.tableData =  this.tableData.filter(ele=>!ids.includes(ele.pid));
                    }else if(res.body =='error'){
                        this.$message({
                            showClose: true,
                            message: '添加失败',
                            type: 'error'
                        });
                    }
                })
            },
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
        computed:{
            tableData(){
                let tableData=[];
                this.tableDatas.forEach(element=>{
                    let v=element.title.split('_');
                    let title=v[0];
                    let options=[];
                    if(v[1]){
                        let arr=v[1].split('|');
                        for(let i=0;i<arr.length;i++){
                            let newarr=arr[i].split(':');
                            options.push({key:newarr[0],value:newarr[1]})
                        }
                    }else{
                        options='';
                    }
                    tableData.push({
                        tid:element.tid,
                        title,
                        options,
                        type:element.tname,
                        answer:element.answer,
                        exp:element.exp,
                        author:element.author,
                        sname:element.sname,
                        score:element.score
                    })
                })
                return tableData;
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
            this.$http.get('/home/manageTest.php').then(res=>{
                this.tableDatas = res.body
            })
        }
    }
</script>
<style>

</style>