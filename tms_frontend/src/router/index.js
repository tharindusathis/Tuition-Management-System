import Vue from 'vue'
import Router from 'vue-router'




//--0000_components------------------------------------
// Containers
const DefaultContainer = () => import('@/containers/DefaultContainer')

// Views
const Dashboard = () => import('@/views/Dashboard')

const Colors = () => import('@/views/theme/Colors')
const Typography = () => import('@/views/theme/Typography')

const Charts = () => import('@/views/Charts')
const Widgets = () => import('@/views/Widgets')

// Views - Components
const Cards = () => import('@/views/base/Cards')
const Forms = () => import('@/views/base/Forms')
const Switches = () => import('@/views/base/Switches')
const Tables = () => import('@/views/base/Tables')
const Tabs = () => import('@/views/base/Tabs')
const Breadcrumbs = () => import('@/views/base/Breadcrumbs')
const Carousels = () => import('@/views/base/Carousels')
const Collapses = () => import('@/views/base/Collapses')
const Jumbotrons = () => import('@/views/base/Jumbotrons')
const ListGroups = () => import('@/views/base/ListGroups')
const Navs = () => import('@/views/base/Navs')
const Navbars = () => import('@/views/base/Navbars')
const Paginations = () => import('@/views/base/Paginations')
const Popovers = () => import('@/views/base/Popovers')
const ProgressBars = () => import('@/views/base/ProgressBars')
const Tooltips = () => import('@/views/base/Tooltips')

// Views - Buttons
const StandardButtons = () => import('@/views/buttons/StandardButtons')
const ButtonGroups = () => import('@/views/buttons/ButtonGroups')
const Dropdowns = () => import('@/views/buttons/Dropdowns')
const BrandButtons = () => import('@/views/buttons/BrandButtons')

// Views - Icons
const Flags = () => import('@/views/icons/Flags')
const FontAwesome = () => import('@/views/icons/FontAwesome')
const SimpleLineIcons = () => import('@/views/icons/SimpleLineIcons')
const CoreUIIcons = () => import('@/views/icons/CoreUIIcons')

// Views - Notifications
const Alerts = () => import('@/views/notifications/Alerts')
const Badges = () => import('@/views/notifications/Badges')
const Modals = () => import('@/views/notifications/Modals')

// Views - Pages
const Page404 = () => import('@/views/pages/Page404')
const Page500 = () => import('@/views/pages/Page500')
const Login = () => import('@/views/pages/Login')
const Register = () => import('@/views/pages/Register')

// Users
const Users = () => import('@/views/users/Users')
const User = () => import('@/views/users/User')

const Test = () => import('@/views/0000/ClassLog/Create')

//----------------new components

const CreateClass = () => import('@/views/0000/CreateNew/Class')
const CreateStudent = () => import('@/views/0000/CreateNew/Student')
const CreateAdmin = () => import('@/views/0000/CreateNew/Admin')
const CreateSubject = () => import('@/views/0000/CreateNew/Subject')
const CreateTeacher = () => import('@/views/0000/CreateNew/Teacher')
const CreateHall = () => import('@/views/0000/CreateNew/Hall')
const CreateTimeslot = () => import('@/views/0000/CreateNew/Timeslot')
const CreateClassLog = () => import('@/views/0000/CreateNew/ClassLog')
const CreateExam = () => import('@/views/0000/CreateNew/Exam')
const CreateStudentPayment = () => import('@/views/0000/StudentPayment/Payments')
const CreateTeacherPayment = () => import('@/views/0000/TeacherPayment/Payments')


const Classes = () => import('@/views/0000/TableViews/Classes')
const Admins = () => import('@/views/0000/TableViews/Admins')
const Students = () => import('@/views/0000/TableViews/Students')
const Teachers = () => import('@/views/0000/TableViews/Teachers')
const Subjects = () => import('@/views/0000/TableViews/Subjects')
const Timeslots = () => import('@/views/0000/TableViews/Timeslots')
const Halls = () => import('@/views/0000/TableViews/Halls')
const ClassLogs = () => import('@/views/0000/TableViews/ClassLogs')
const Exams = () => import('@/views/0000/TableViews/Exams')

const StudentPayments = () => import('@/views/0000/TableViews/StudentPayments')
const TeacherPayments = () => import('@/views/0000/TableViews/TeacherPayments')




//--0000_components------------------------------------
const SearchTable = () => import('@/views/0000/SearchTable')
const TableAdmins = () => import('@/views/0000/Tables/TableAdmins')
const TableClasses = () => import('@/views/0000/Tables/TableClasses')
const TableClassLogs = () => import('@/views/0000/Tables/TableClassLogs')
const TableExams = () => import('@/views/0000/Tables/TableExams')
const TableHalls = () => import('@/views/0000/Tables/TableHalls')
const TableStudentPayments = () => import('@/views/0000/Tables/TableStudentPayments')
const TableStudents = () => import('@/views/0000/Tables/TableStudents')
const TableSubjects = () => import('@/views/0000/Tables/TableSubjects')
const TableTeacherPayments = () => import('@/views/0000/Tables/TableTeacherPayments')
const TableTeachers = () => import('@/views/0000/Tables/TableTeachers')
const TableTimeslots = () => import('@/views/0000/Tables/TableTimeslots')
const TableUsers = () => import('@/views/0000/Tables/TableUsers')

Vue.use(Router)

export default new Router({
  mode: 'hash', // https://router.vuejs.org/api/#mode
  linkActiveClass: 'open active',
  scrollBehavior: () => ({ y: 0 }),
  routes: [
    

   {
      path: '/',
      redirect: '/dashboard',
      name: 'Home',
      component: DefaultContainer,
      children: [
        {
          path: 'dashboard',
          name: 'Dashboard',
          component: Dashboard
        },
        {
          path: 'test',
          name: 'test',
          component: Test
        },
        //-----------0000------------------------------------
        {
          path: 'searchtable',
          name: 'Search Table',
          component: SearchTable
        },

        //---create new 
        {
            path: 'new_class',
            name: 'New Class',
            component: CreateClass
        },
        {
            path: 'new_student',
            name: 'New Student',
            component: CreateStudent
        },
        {
            path: 'new_admin',
            name: 'New Admin',
            component: CreateAdmin
        },
        {
            path: 'new_teacher',
            name: 'New Teacher',
            component: CreateTeacher
        },
        {
            path: 'new_subject',
            name: 'New Subject',
            component: CreateSubject
        },
        {
            path: 'new_hall',
            name: 'New Hall',
            component: CreateHall
        },
        {
            path: 'new_studentpayment',
            name: 'New Student Payment',
            component: CreateStudentPayment
        },
        {
            path: 'new_teacherpayment',
            name: 'New Teacher Payment',
            component: CreateTeacherPayment
        },
        {
            path: 'new_timeslot',
            name: 'New Timeslot',
            component: CreateTimeslot
        },
        {
            path: 'new_classlog',
            name: 'New Class Log',
            component: CreateClassLog
        },
        {
            path: 'new_exam',
            name: 'New Exam',
            component: CreateExam
        },


        {
          path: 'classes',
          name: 'Classes',
          component: Classes, 
        },
          {
          path: 'students',
          name: 'Students',
          component: Students
        }, {
          path: 'teachers',
          name: 'Teachers',
          component: Teachers
        }, {
          path: 'halls',
          name: 'Halls',
          component: Halls
        }, {
          path: 'subjects',
          name: 'Subjects',
          component: Subjects
        }, {
          path: 'timeslots',
          name: 'Timeslots',
          component: Timeslots
        }, {
          path: 'exams',
          name: 'Exams',
          component: Exams
        }, {
          path: 'class_logs',
          name: 'Class Logs',
          component: ClassLogs
        }, {
          path: 'student_payments',
          name: 'Students Payments',
          component: StudentPayments
        }, {
          path: 'teacher_payments',
          name: 'Teachers Payments',
          component: TeacherPayments
        }, {
          path: 'admins',
          name: 'Administrators',
          component: Admins
        }, {
          path: 'users',
          name: 'Users',
          component: TableUsers
        },
        //-----------/0000------------------------------------
        {
          path: 'theme',
          redirect: '/theme/colors',
          name: 'Theme',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'colors',
              name: 'Colors',
              component: Colors
            },
            {
              path: 'typography',
              name: 'Typography',
              component: Typography
            }
          ]
        },
        {
          path: 'charts',
          name: 'Charts',
          component: Charts
        },
        {
          path: 'widgets',
          name: 'Widgets',
          component: Widgets
        },
        {
          path: 'users',
          meta: { label: 'Users'},
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: '',
              component: Users,
            },
            {
              path: ':id',
              meta: { label: 'User Details'},
              name: 'User',
              component: User,
            },
          ]
        },
        {
          path: 'base',
          redirect: '/base/cards',
          name: 'Base',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'cards',
              name: 'Cards',
              component: Cards
            },
            {
              path: 'forms',
              name: 'Forms',
              component: Forms
            },
            {
              path: 'switches',
              name: 'Switches',
              component: Switches
            },
            {
              path: 'tables',
              name: 'Tables',
              component: Tables
            },
            {
              path: 'tabs',
              name: 'Tabs',
              component: Tabs
            },
            {
              path: 'breadcrumbs',
              name: 'Breadcrumbs',
              component: Breadcrumbs
            },
            {
              path: 'carousels',
              name: 'Carousels',
              component: Carousels
            },
            {
              path: 'collapses',
              name: 'Collapses',
              component: Collapses
            },
            {
              path: 'jumbotrons',
              name: 'Jumbotrons',
              component: Jumbotrons
            },
            {
              path: 'list-groups',
              name: 'List Groups',
              component: ListGroups
            },
            {
              path: 'navs',
              name: 'Navs',
              component: Navs
            },
            {
              path: 'navbars',
              name: 'Navbars',
              component: Navbars
            },
            {
              path: 'paginations',
              name: 'Paginations',
              component: Paginations
            },
            {
              path: 'popovers',
              name: 'Popovers',
              component: Popovers
            },
            {
              path: 'progress-bars',
              name: 'Progress Bars',
              component: ProgressBars
            },
            {
              path: 'tooltips',
              name: 'Tooltips',
              component: Tooltips
            }
          ]
        },
        {
          path: 'buttons',
          redirect: '/buttons/standard-buttons',
          name: 'Buttons',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'standard-buttons',
              name: 'Standard Buttons',
              component: StandardButtons
            },
            {
              path: 'button-groups',
              name: 'Button Groups',
              component: ButtonGroups
            },
            {
              path: 'dropdowns',
              name: 'Dropdowns',
              component: Dropdowns
            },
            {
              path: 'brand-buttons',
              name: 'Brand Buttons',
              component: BrandButtons
            }
          ]
        },
        {
          path: 'icons',
          redirect: '/icons/font-awesome',
          name: 'Icons',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'coreui-icons',
              name: 'CoreUI Icons',
              component: CoreUIIcons
            },
            {
              path: 'flags',
              name: 'Flags',
              component: Flags
            },
            {
              path: 'font-awesome',
              name: 'Font Awesome',
              component: FontAwesome
            },
            {
              path: 'simple-line-icons',
              name: 'Simple Line Icons',
              component: SimpleLineIcons
            }
          ]
        },
        {
          path: 'notifications',
          redirect: '/notifications/alerts',
          name: 'Notifications',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'alerts',
              name: 'Alerts',
              component: Alerts
            },
            {
              path: 'badges',
              name: 'Badges',
              component: Badges
            },
            {
              path: 'modals',
              name: 'Modals',
              component: Modals
            }
          ]
        }
      ]
    },
    {
      path: '/pages',
      redirect: '/pages/404',
      name: 'Pages',
      component: {
        render (c) { return c('router-view') }
      },
      children: [
        {
          path: '404',
          name: 'Page404',
          component: Page404
        },
        {
          path: '500',
          name: 'Page500',
          component: Page500
        },
        {
          path: 'login',
          name: 'Login',
          component: Login
        },
        {
          path: 'register',
          name: 'Register',
          component: Register
        }
      ]
    }
  ]
})
