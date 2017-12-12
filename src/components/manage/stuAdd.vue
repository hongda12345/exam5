<template>
    <div>
        <el-form ref="form" :model="form" label-width="80px" :rules="rules" style="padding:40px 30px 20px 20px;background: #ffffff;border-radius: 5px;box-shadow: 0 0 5px rgba(0,0,0,0.5)">
            <el-form-item label="学生姓名" prop="mname">
                <el-input  type="text" v-model="form.mname"></el-input>
            </el-form-item>
            <el-form-item label="性别">
                <el-radio-group v-model="form.msex">
                    <el-radio label="男">男</el-radio>
                    <el-radio label="女">女</el-radio>
                </el-radio-group>
            </el-form-item>
            <el-form-item label="学号" prop="mnum">
                <el-input  type="text" v-model="form.mnum"></el-input>
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
        <el-form ref="form1" label-width="80px" style="padding:40px 30px 20px 20px;background: #ffffff;border-radius: 5px;box-shadow: 0 0 5px rgba(0,0,0,0.5)">
            <el-form-item label="Excel">
                <div @drop="_drop" @dragenter="_suppress" @dragover="_suppress">
                    <input type="file" class="form-control" id="file" :accept="SheetJSFT" @change="_change" />
                </div>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="submitExcel()">上传</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>
<script>
    const _XLSX = require('xlsx');
    const X = typeof XLSX !== 'undefined' ? XLSX : _XLSX;
    const make_cols = refstr => Array(X.utils.decode_range(refstr).e.c + 1).fill(0).map((x,i) => ({name:X.utils.encode_col(i), key:i}));
    /* see Browser download file example in docs */
    function s2ab(s) {
        const buf = new ArrayBuffer(s.length);
        const view = new Uint8Array(buf);
        for (let i=0; i!=s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
        return buf;
    }
    const _SheetJSFT = [
        "xlsx", "xlsb", "xlsm", "xls", "xml", "csv", "txt", "ods", "fods", "uos", "sylk", "dif", "dbf", "prn", "qpw", "123", "wb*", "wq*", "html", "htm"
    ].map(function(x) { return "." + x; }).join(",");
    export default{
        name:'stuAdd',
        data() {
            return {
                direction:[],
                stage:[],
                classes:[],
                data:[],
                SheetJSFT:_SheetJSFT,
                form: {
                    mname: '',
                    msex:'',
                    mnum:'',
                    did:'',
                    sid:'',
                    cid:''
                },
                rules: {
                    mname: [
                        { required: true, message: '请输入教师姓名', trigger: 'blur' },
                        { min: 1, max: 20, message: '长度在 1 到 20 个字符', trigger: 'blur' }
                    ],
                    mnum: [
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
                        this.$http.post('/home/stuAdd.php',this.form).then(res=>{
                            if(res.body=='ok'){
                                this.$message({
                                    message:'恭喜你，添加成功',
                                    type:"success"
                                })
                                this.$router.push('manageStu')
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
            },
            _suppress(evt) {
                evt.stopPropagation();
                evt.preventDefault();
            },
            _drop(evt) {
                evt.stopPropagation();
                evt.preventDefault();
                const files = evt.dataTransfer.files;
                if (files && files[0]) this._file(files[0]);
            },
            _change(evt) {
                const files = evt.target.files;
                if (files && files[0]) this._file(files[0]);
            },
            _export(evt) {
                /* convert state to workbook */
                const ws = X.utils.aoa_to_sheet(this.data);
                const wb = X.utils.book_new();
                X.utils.book_append_sheet(wb, ws, "SheetJS");
                /* generate X file */
                const wbout = X.write(wb, {type: "binary", bookType: "xlsx"});
                /* send to client */
                saveAs(new Blob([s2ab(wbout)], {type: "application/octet-stream"}), "sheetjs.xlsx");
            },
            _file(file) {
                /* Boilerplate to set up FileReader */
                const reader = new FileReader();
                reader.onload = (e) => {
                    /* Parse data */
                    const bstr = e.target.result;
                    const wb = X.read(bstr, {type: 'binary'});
                    /* Get first worksheet */
                    const wsname = wb.SheetNames[0];
                    const ws = wb.Sheets[wsname];
                    /* Convert array of arrays */
                    const data = X.utils.sheet_to_json(ws, {header: 1});
                    /* Update state */
                    this.data = data.splice(1);
                    this.cols = make_cols(ws['!ref']);
                };
                reader.readAsBinaryString(file);
            },
            submitExcel() {
                this.$http.post('/home/stuAddExcel.php', {data: this.data}).then(res => {
                    if (res.body == 'ok') {
                        this.$message({
                            showClose: true,
                            message: '恭喜你，添加成功',
                            type: "success"
                        })
                        this.$router.push('manageStu')
                    } else if (res.body == 'error') {
                        this.$message({
                            showClose: true,
                            message: '对不起，添加失败',
                            type: "error"
                        })
                    }
                })
            }
        },
        mounted(){
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