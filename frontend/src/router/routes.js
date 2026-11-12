const routes = [
  {
    path: "/dashboard",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      { path: "", component: () => import("pages/IndexPage.vue") },
      {
        path: "portfolio",
        component: () => import("pages/Portfolio/Index.vue"),
      },
      {
        path: "marketplace",
        component: () => import("pages/Marketplace/Index.vue"),
      },
      {
        path: "portfolio/add",
        component: () => import("pages/Portfolio/Form/Add.vue"),
      },
      {
        path: "collections",
        component: () => import("pages/Collections/Index.vue"),
      },
      {
        path: "collections/add",
        component: () => import("pages/Collections/Form/Add.vue"),
      },
      {
        path: "collections/add/:collectionId",
        component: () => import("pages/Collections/Form/Edit.vue"),
      },
    ],
  },
  {
    path: "/",
    component: () => import("layouts/Empty.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/Profile/Login.vue"),
      },
      {
        path: "register",
        component: () => import("pages/Profile/Register.vue"),
      },
      {
        path: "forgot-password",
        component: () => import("pages/Profile/ForgotPassword.vue"),
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];

export default routes;
