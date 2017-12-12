import Vue from 'vue'
import Router from 'vue-router'
import ElementUI from 'element-ui'
import VueResource from 'vue-resource'
import 'element-ui/lib/theme-chalk/index.css'
import login from '../components/login/login.vue'
/*manage*/
import manage from '../components/manage/manage.vue'

import manageDir from '../components/manage/manageDir.vue'
import dirUpdate from '../components/manage/dirUpdate.vue'
import dirAdd from '../components/manage/dirAdd.vue'

import manageStage from '../components/manage/manageStage.vue'
import stageAdd from '../components/manage/stageAdd.vue'
import stageUpdate from '../components/manage/stageUpdate.vue'

import manageClass from '../components/manage/manageClass.vue'
import classUpdate from '../components/manage/classUpdate.vue'
import classAdd from '../components/manage/classAdd.vue'

import manageStu from '../components/manage/manageStu.vue'
import stuUpdate from '../components/manage/stuUpdate.vue'
import stuAdd from '../components/manage/stuAdd.vue'

import manageTea from '../components/manage/manageTea.vue'
import teaUpdate from '../components/manage/teaUpdate.vue'
import teaAdd from '../components/manage/teaAdd.vue'

/*teacher*/
import teacher from '../components/teacher/teacher.vue'

import manageType from '../components/teacher/manageType.vue'
import typeUpdate from '../components/teacher/typeUpdate.vue'
import typeAdd from '../components/teacher/typeAdd.vue'

import manageTest from '../components/teacher/manageTest.vue'
import testUpdate from '../components/teacher/testUpdate.vue'
import testAdd from '../components/teacher/testAdd.vue'

import managePaper from '../components/teacher/managePaper.vue'
import paperUpdate from '../components/teacher/paperUpdate.vue'
import paperAdd from '../components/teacher/paperAdd.vue'
import paperExtraUpdate from '../components/teacher/paperExtraUpdate.vue'

/*student*/
import student from '../components/student/student.vue'
import studentExam from '../components/student/studentExam.vue'
import studentPaper from '../components/student/studentPaper.vue'
import studentHistory from '../components/student/studentHistory.vue'

Vue.use(Router)
Vue.use(ElementUI)
Vue.use(VueResource)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'login',
      component: login
    },
    {
      path:'/mangage',
      name: 'manage',
      component: manage,
          children:[
              {
                 path:'manageDir',
                 name:'manageDir',
                 component:manageDir
              },
              {
                 path:'dirUpdate',
                 name:'dirUpdate',
                 component:dirUpdate
              },
              {
                  path:'dirAdd',
                  name:'dirAdd',
                  component:dirAdd
              },
              {
                  path:'manageStage',
                  name:'manageStage',
                  component:manageStage
              },
              {
                  path:'stageAdd',
                  name:'stageAdd',
                  component:stageAdd
              },
              {
                  path:'stageUpdate',
                  name:'stageUpdate',
                  component:stageUpdate
              },
              {
                  path:'manageClass',
                  name:'manageClass',
                  component:manageClass
              },
              {
                  path:'classAdd',
                  name:'classAdd',
                  component:classAdd
              },
              {
                  path:'classUpdate',
                  name:'classUpdate',
                  component:classUpdate
              },
              {
                  path:'manageStu',
                  name:'manageStu',
                  component:manageStu
              },
              {
                  path:'stuAdd',
                  name:'stuAdd',
                  component:stuAdd
              },
              {
                  path:'stuUpdate',
                  name:'stuUpdate',
                  component:stuUpdate
              },
              {
                  path:'manageTea',
                  name:'manageTea',
                  component:manageTea
              },
              {
                  path:'teaAdd',
                  name:'teaAdd',
                  component:teaAdd
              },
              {
                  path:'teaUpdate',
                  name:'teaUpdate',
                  component:teaUpdate
              },
          ]
    },
    {
      path:'/teacher',
      name:'teacher',
      component:teacher,
          children:[
              {
                  path:'manageType',
                  name:'manageType',
                  component:manageType
              },
              {
                  path:'typeUpdate',
                  name:'typeUpdate',
                  component:typeUpdate
              },
              {
                  path:'typeAdd',
                  name:'typeAdd',
                  component:typeAdd
              },
              {
                  path:'manageTest',
                  name:'manageTest',
                  component:manageTest
              },
              {
                  path:'testUpdate',
                  name:'testUpdate',
                  component:testUpdate
              },
              {
                  path:'testAdd',
                  name:'testAdd',
                  component:testAdd
              },
              {
                  path:'managePaper',
                  name:'managePaper',
                  component:managePaper
              },
              {
                  path:'paperUpdate',
                  name:'paperUpdate',
                  component:paperUpdate
              },
              {
                  path:'paperAdd',
                  name:'paperAdd',
                  component:paperAdd
              },
              {
                  path:'paperExtraUpdate',
                  name:'paperExtraUpdate',
                  component:paperExtraUpdate
              },
          ]
    },
    {
      path: '/student',
      name: 'student',
      component: student,
          children: [
              {
                  path: 'studentExam',
                  name: 'studentExam',
                  component: studentExam
              },
              {
                  path: 'studentPaper',
                  name: 'studentPaper',
                  component: studentPaper
              },
              {
                  path: 'studentHistory',
                  name: 'studentHistory',
                  component: studentHistory
              },
          ]
    }
  ]
})
