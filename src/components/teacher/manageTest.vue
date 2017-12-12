<template>
    <div>
        <div class="panel admin-panel">
            <div class="panel-head"><strong class="icon-reorder"> 内容列表</strong></div>
            <div class="padding border-bottom">
                <a class="button border-yellow"><span class="icon-plus-square-o"></span><router-link :to="{name:'testAdd'}"> 添加内容</router-link></a>
            </div>
            <el-table :data="tableData" style="width: 100%" height="365">
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
        </div>
    </div>
</template>
<script>
    export default{
        name:'manageTest',
        data() {
            return {
                tableDatas: []
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
        methods:{
            del(tid){
                this.$http.post('/home/testDelete.php',{tid}).then(res=>{
                    if(res.body=='ok'){
                        this.tableDatas=this.tableDatas.filter(ele=>ele.tid!=tid);
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
            this.$http.get('/home/manageTest.php').then(res=>{
                this.tableDatas = res.body
            })
        }
    }
</script>
<style>
    @import "../../assets/css/admin.css";
    @import "../../assets/css/pintuer.css";
</style>