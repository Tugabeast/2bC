(this.webpackJsonpsidebartest=this.webpackJsonpsidebartest||[]).push([[0],{111:function(e,a,t){e.exports=t(146)},116:function(e,a,t){},122:function(e,a,t){},140:function(e,a,t){},142:function(e,a,t){},143:function(e,a,t){},144:function(e,a,t){},145:function(e,a,t){},146:function(e,a,t){"use strict";t.r(a);var n=t(1),r=t.n(n),c=t(11),l=t.n(c),o=(t(116),t(29)),i=t(86),s=t(60),m=(t(73),[{title:"Home",path:"/",icon:r.a.createElement(i.a,null),cName:"nav-text"},{title:"Graphics",path:"/reports",icon:r.a.createElement(s.a,null),cName:"nav-text"}]),u=t(0),d=t(61);var E=function(){return r.a.createElement(u.b.Provider,{value:{color:"white",size:"30px"}},r.a.createElement("div",{className:"navbar"},r.a.createElement("div",{className:"menu-bars"},r.a.createElement(d.a,null))),r.a.createElement("nav",{className:"nav-menu"},r.a.createElement("p",{className:"nav-menu-items",onClick:function(e){e.preventDefault()}},m.map((function(e,a){return r.a.createElement("div",{key:a,className:e.cName},r.a.createElement(o.b,{to:e.path},r.a.createElement("div",{className:"menu-icon-text"},r.a.createElement("span",{className:"menu-icon"},e.icon),r.a.createElement("span",{className:"menu-text"},e.title))))})))))},p=t(12),f=t(49),b=t.n(f),v=t(64),g=t(16),h=Object(n.createContext)({}),N=(t(75),t(122),t(34)),O=t.n(N),j=(t(140),t(95)),x=(t(84),t(90)),k=t(208),y=t(209),w=t(205),C=t(91),S=t.n(C);var R=function(e){var a=e.area,t=e.props,c=e.name,l=Object(w.a)("div")(Object(x.a)(k.b,y.a)),i=Object(n.useContext)(h).state;return r.a.createElement(r.a.Fragment,null,r.a.createElement(l,{p:4,onClick:function(e){e.preventDefault(),function(e){i.listEvent=e}(t)}},r.a.createElement("div",null),r.a.createElement("h1",{className:"card-header"},"  ",c," "),r.a.createElement("div",{className:"card-number"},r.a.createElement("p",null,a.length,r.a.createElement(S.a,null))),r.a.createElement(o.b,{to:"/Workers"},r.a.createElement(j.a,{class:"btn"},"Detalhes"))))},P=t(202),M=t(204),F=t(188),I=t(186),D=t(187),_=t(185),B=t(148);var W=function(e){var a=e.name,t=e.globalState,c=Object(n.useContext)(h).state,l=Object(_.a)({root:{color:"white",backgroundColor:"#3b70b1",borderRadius:"15px"},label:{}})(),o=Object(_.a)({root:{border:" 3px solid black",borderRadius:"15px",padding:"25px"},label:{textAlign:"center",backgroundColor:"#3b70b1",color:"white",borderRadius:"15px",height:"40px",padding:"10px"},Radio:{marginRight:"20px"},status:{fontWeight:"1000"}})(),i=Object(n.useState)(t),s=Object(g.a)(i,2),m=s[0],u=s[1],d=Object(n.useState)(t),E=Object(g.a)(d,2),p=E[0],f=E[1];return r.a.createElement(I.a,{component:"fieldset"},r.a.createElement(D.a,{component:"legend",className:o.label},a),r.a.createElement(M.a,{className:o.root,"aria-label":"status",name:a,value:m,onChange:function(e){u(e.target.value)}},r.a.createElement("p",{className:o.status},"Status: ","standby"==p?"StandBy":"","emergency"==p?"Emerg\xeancia":"","evacuation"==p?"Evacua\xe7\xe3o":"","endEmergency"==p?"Fim Emerg\xeancia":""),r.a.createElement(F.a,{value:"standby",control:r.a.createElement(P.a,{className:o.Radio}),label:"StandBy"}),r.a.createElement(F.a,{value:"emergency",control:r.a.createElement(P.a,{className:o.Radio}),label:"Emerg\xeancia"}),r.a.createElement(F.a,{value:"evacuation",control:r.a.createElement(P.a,{className:o.Radio}),label:"Evacua\xe7\xe3o"}),r.a.createElement(F.a,{value:"endEmergency",control:r.a.createElement(P.a,{className:o.Radio}),label:"Fim Emerg\xeancia"})),r.a.createElement(B.a,{className:l.root,variant:"contained",onClick:function(){f(m),"emergency"===p&&(c.emergencyFlag=!0)}},"Submeter"))},A=(t(142),t(201)),Z=t(190),H=t(92),z=t.n(H);var J=function(e){var a,t=e.search,c=Object(_.a)((function(e){return{margin:{margin:e.spacing(1)}}}))(),l=Object(n.useContext)(h).state,i=Object(n.useState)("Nome"),s=Object(g.a)(i,2),m=s[0],u=(s[1],Object(n.useState)("")),d=Object(g.a)(u,2),E=d[0],p=d[1];return r.a.createElement("div",{className:"search"},r.a.createElement("div",{class:"table",onChange:(a=m,void(E.length>0&&(t=t.filter((function(e){return"Id"===a?e.id.match(E):"Nome"===a?e.name.toLowerCase().match(E):"Area"===a?e.area.match(E):void 0})))))},r.a.createElement("div",{class:"row header"},r.a.createElement("div",{class:"cell-index"},"Nome"),r.a.createElement("div",{class:"cell-index"},"Empresa")),r.a.createElement("scroll-container",null,r.a.createElement("div",{class:"row"},r.a.createElement("div",{class:"cell","data-title":"Name"},t.sort((function(e,a){return e.name.localeCompare(a.name)})).map((function(e){return r.a.createElement("p",{className:0==e.area?"text-not-safe":"text-safe",onClick:function(){l.id=e.id}}," ",0==e.area?r.a.createElement(o.b,{to:"/infoCard",style:{color:"inherit"}},e.name):r.a.createElement("p",null,e.name))}))),r.a.createElement("div",{class:"cell","data-title":"company"},t.map((function(e){return r.a.createElement("p",{className:0==e.area?"text-not-safe":"text-safe"},e.enmpresa)})))))),r.a.createElement(A.a,{className:c.margin,placeholder:m,onChange:function(e){e.preventDefault(),p(e.target.value)},value:E,id:"input-with-icon-textfield",label:"Pesquisa",InputProps:{startAdornment:r.a.createElement(Z.a,{position:"start"},r.a.createElement(z.a,null))}}))};t(143);var q=function(e){var a=e.safe,t=e.notSafe,n={opacity:"1",width:"".concat(100*a/t,"%"),backgroundColor:"green"};return r.a.createElement("div",{className:"progressBar"},r.a.createElement("p",{className:"text-progressbar"},a," / ",t),r.a.createElement("div",{class:"progress",style:{width:"100%",backgroundColor:"red",height:"45px",border:"5px solid"}},r.a.createElement("div",{style:n})))};var G=function(){var e=Object(n.useContext)(h).state,a=Object(n.useState)([]),t=Object(g.a)(a,2),c=t[0],l=t[1],o=Object(n.useState)(1e4),i=Object(g.a)(o,2),s=i[0],m=i[1],u=function(){var e=Object(v.a)(b.a.mark((function e(){return b.a.wrap((function(e){for(;;)switch(e.prev=e.next){case 0:O.a.get("http://localhost/db-meeting-point/workers/readWorkersData.php").then((function(e){l(e.data.workers.map((function(e){return e})))})).catch((function(e){console.log(e)}));case 1:case"end":return e.stop()}}),e)})));return function(){return e.apply(this,arguments)}}();Object(n.useEffect)((function(){u()}),[]),Object(n.useEffect)((function(){var e=!0,a=setInterval((function(){(function(){var a=Object(v.a)(b.a.mark((function a(){var t;return b.a.wrap((function(a){for(;;)switch(a.prev=a.next){case 0:return a.prev=0,"http://localhost/db-meeting-point/workers/readWorkersData.php",a.next=4,O.a.get("http://localhost/db-meeting-point/workers/readWorkersData.php");case 4:t=a.sent,e&&l(t.data.workers.map((function(e){return e}))),a.next=11;break;case 8:a.prev=8,a.t0=a.catch(0),console.log(a.t0);case 11:case"end":return a.stop()}}),a,null,[[0,8]])})));return function(){return a.apply(this,arguments)}})()()}),s);return function(){e=!1,clearInterval(a)}}),[s]),Object(n.useEffect)((function(){e.emergencyFlag&&m(5e3)}));var d=c.filter((function(e){return 1==e.area})),E=c.filter((function(e){return 2==e.area})),p=c.filter((function(e){return 3==e.area})),f=c.filter((function(e){return 4==e.area})),N=c.filter((function(e){return 5==e.area})),j=c;return r.a.createElement("div",{className:"home-open"}," ",r.a.createElement("div",{className:"progresBar"},r.a.createElement(q,{safe:d.length+E.length+p.length+f.length+N.length,notSafe:c.length})),r.a.createElement("div",{className:"search"},r.a.createElement(J,{search:j})),r.a.createElement("div",{className:"config"},r.a.createElement("h1",null,"Configura\xe7\xe3o"),r.a.createElement("div",{className:"box-config"},r.a.createElement(W,{name:"MP_1",globalState:e.buttonRadio.radio1}),r.a.createElement(W,{name:"MP_2",globalState:e.buttonRadio.radio2}),r.a.createElement(W,{name:"MP_3",globalState:e.buttonRadio.radio3}),r.a.createElement(W,{name:"MP_4",globalState:e.buttonRadio.radio4}),r.a.createElement(W,{name:"Brigadistas",globalState:e.buttonRadio.radio5}))),r.a.createElement("div",null,r.a.createElement("h1",null,"Zonas Ponta de Encontro"),r.a.createElement("div",{className:"cards"},r.a.createElement("div",{className:"card"},r.a.createElement(R,{area:d,props:1,name:"MP_1"})),r.a.createElement("div",{className:"card"},r.a.createElement(R,{area:E,props:2,name:"MP_2"})),r.a.createElement("div",{className:"card"},r.a.createElement(R,{area:p,props:3,name:"MP_3"})),r.a.createElement("div",{className:"card"},r.a.createElement(R,{area:f,props:4,name:"MP_4"})),r.a.createElement("div",{className:"card"},r.a.createElement(R,{area:N,props:5,name:"Brigadistas"})))))};t(144);var L=function(){return r.a.createElement("footer",{className:"footerReports"},"Meeting Point 2020")},T=(t(145),t(189)),Y=t(191),K=t(192),Q=t(193),U=t(194),V=t(195),X=t(196);var $=function(){var e=Object(_.a)({root:{width:"100%",borderRadius:5},container:{maxHeight:250,maxWidth:700}})(),a=Object(n.useState)([]),t=Object(g.a)(a,2),c=t[0],l=t[1];Object(n.useEffect)((function(){O.a.get("http://localhost/db-meeting-point/workers/readWorkersData.php").then((function(e){l(e.data.workers.map((function(e){return e})))})).catch((function(e){console.log(e)}))}),[]);var o=Object(n.useContext)(h).state,i=0===o.listEvent?"Fora da Zona Segura":o.listEvent;return r.a.createElement("div",{className:"list"},r.a.createElement(T.a,{className:e.root},r.a.createElement(Y.a,{className:e.container},r.a.createElement(K.a,{stickyHeader:!0,"aria-label":"sticky table"},r.a.createElement(Q.a,null,r.a.createElement(U.a,null,r.a.createElement("div",null,r.a.createElement(V.a,{className:"column-name"},5===i?"Brigadistas":"MP_"+i)))),r.a.createElement(X.a,null,c.filter((function(e){return e.area==o.listEvent})).sort((function(e,a){return e.name.localeCompare(a.name)})).map((function(e){return r.a.createElement(U.a,{hover:!0,role:"checkbox",tabIndex:-1,key:e.id},r.a.createElement("div",null,r.a.createElement(V.a,{className:"column-name"},e.name),r.a.createElement(V.a,{className:"column-company"},e.enmpresa)))})))))))},ee=t(197),ae=t(198),te=t(93),ne=t.n(te),re=t(200),ce=t(203),le=t(199),oe=t(207),ie=t(206),se=["1","2","3","4","5"];var me=function(){var e=Object(n.useContext)(h).state,a=parseInt(e.id);console.log(typeof a);var t=Object(n.useState)(!1),c=Object(g.a)(t,2),l=c[0],o=c[1],i=Object(n.useRef)(null),s=Object(n.useState)(),m=Object(g.a)(s,2),u=m[0],d=m[1],E=function(){console.info("You clicked ".concat(se[u]))},p=function(){o((function(e){return!e}))},f=function(e){i.current&&i.current.contains(e.target)||o(!1)},b=Object(n.useState)([]),v=Object(g.a)(b,2),N=v[0],j=v[1];return Object(n.useEffect)((function(){O.a.get("http://localhost/db-meeting-point/workers/readWorkersData.php").then((function(e){j(e.data.workers.map((function(e){return e})))})).catch((function(e){console.log(e)}))}),[]),r.a.createElement(r.a.Fragment,null,r.a.createElement("div",{className:"list"},r.a.createElement("table",{class:"content-table"},r.a.createElement("thead",null,r.a.createElement("tr",null,r.a.createElement("th",null,"Info"))),r.a.createElement("tbody",null,r.a.createElement("tr",null,N.filter((function(a){return a.id==e.id})).map((function(e){return r.a.createElement("div",null,r.a.createElement("p",null,"Id: ",e.id),r.a.createElement("p",null,"Nome: ",e.name),r.a.createElement("p",null,"Empresa: ",e.enmpresa),r.a.createElement("p",null,"Estado:"," ",0==e.area?r.a.createElement("strong",null,"Fora da Zona de Seguran\xe7a"):"Zona "+e.area,r.a.createElement(ee.a,{container:!0,direction:"column",alignItems:"left"},r.a.createElement(ee.a,{item:!0,xs:12},r.a.createElement(ae.a,{variant:"contained",color:"primary",ref:i,"aria-label":"split button"},r.a.createElement(B.a,{onClick:E},se[u]),r.a.createElement(B.a,{color:"primary",size:"small","aria-controls":l?"split-button-menu":void 0,"aria-expanded":l?"true":void 0,"aria-label":"select merge strategy","aria-haspopup":"menu",onClick:p},r.a.createElement(ne.a,null))),r.a.createElement(le.a,{open:l,anchorEl:i.current,role:void 0,transition:!0,disablePortal:!0},(function(a){var t=a.TransitionProps,n=a.placement;return r.a.createElement(ce.a,Object.assign({},t,{style:{transformOrigin:"bottom"===n?"center top":"center bottom"}}),r.a.createElement(T.a,null,r.a.createElement(re.a,{onClickAway:f},r.a.createElement(ie.a,{id:"split-button-menu"},se.map((function(a,t){return r.a.createElement(oe.a,{key:a,disabled:t===e.id,selected:t===u,onClick:function(e){return function(e,a){d(a),o(!1)}(0,t)}},a)}))))))}))))," ")," ",r.a.createElement(B.a,{class:"btn"},"Submeter"))})))))))};var ue=function(){return r.a.createElement(r.a.Fragment,null,r.a.createElement(o.a,null,r.a.createElement(E,null),r.a.createElement(p.c,null,r.a.createElement(p.a,{path:"/",exact:!0,component:G}),r.a.createElement(p.a,{path:"/workers",component:$}),r.a.createElement(p.a,{path:"/infoCard",component:me}))),r.a.createElement(L,null))},de=function(){var e=Object(n.useState)({listEvent:1,id:0,buttonRadio:{radio1:"standby",radio2:"standby",radio3:"standby",radio4:"standby",radio5:"standby"},emergencyFlag:!1}),a=Object(g.a)(e,2),t=a[0],r=a[1];return{state:t,actions:function(e){var a=e.type,n=e.payload;switch(a){case"setState":return r(n);default:return t}}}},Ee=function(){var e=de();return r.a.createElement(h.Provider,{value:e},r.a.createElement(ue,null))};l.a.render(r.a.createElement(r.a.StrictMode,null,r.a.createElement(Ee,null)),document.getElementById("root"))},73:function(e,a,t){},75:function(e,a,t){},84:function(e,a,t){}},[[111,1,2]]]);
//# sourceMappingURL=main.77990ca5.chunk.js.map