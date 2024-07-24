import{a as b,B as C,f as L,D as c}from"./links.CKSg78-h.js";import{l as g}from"./license.8zyTf6Rb.js";import{C as B}from"./Caret.Cuasz9Up.js";import{y as o,o as r,l,m as n,a as y,t as d,d as u,c as _,D as p,x as S,E as D}from"./vue.esm-bundler.DzelZkHk.js";import{_ as h}from"./_plugin-vue_export-helper.BN1snXvA.js";import{B as M}from"./DatePicker.9jCaxc1v.js";import{C as T}from"./Blur.B433XVqJ.js";import{C as A}from"./Index.BcrR8EtF.js";import O from"./ContentRankings.CRJkXCEX.js";import{C as J}from"./Index.Ck0NNxBQ.js";import R from"./Dashboard.C4r3OD2M.js";import N from"./KeywordRankings.DasTe9uo.js";import P from"./SeoStatistics.DL51Ezwi.js";import"./default-i18n.BtxsUzQk.js";import"./isArrayLikeObject.CkjpbQo7.js";import"./upperFirst.Cx8cdEgZ.js";import"./_stringToArray.DnK4tKcY.js";import"./toString.EVG10Qqs.js";import"./get.CmvQfcJ_.js";import"./isUndefined.2CoGFx8R.js";import"./_getTag.0B4_HiWU.js";import"./debounce.vOAperWf.js";import"./toNumber.DHWd7Z3r.js";import"./_baseTrim.BYZhh0MR.js";import"./allowed.B_mIy271.js";/* empty css             */import"./params.B3T1WKlC.js";import"./Ellipse.HvxcRElJ.js";import"./Header.CI74i-Kf.js";import"./addons.Bhqo_sme.js";import"./ScrollAndHighlight.DCpqKtXJ.js";import"./LogoGear.oMlhtqmB.js";import"./AnimatedNumber.BZqhDXvl.js";import"./numbers.ursUutt1.js";import"./Logo.CuK32Muc.js";import"./index.DX4OhBfI.js";import"./Support.B5EAN5JN.js";import"./Tabs.Cl9YKSoz.js";import"./TruSeoScore.-L7x872T.js";import"./Information.Dx9dnFtu.js";import"./Slide.BfXXFx9A.js";import"./Url.DUcj4Th3.js";import"./Date.Bc79vv_Y.js";import"./constants.DARe-ccJ.js";import"./Exclamation.BU2oeqa4.js";import"./Gear.CzHv0eD2.js";import"./Row.ou4tdPuA.js";import"./PostsTable.BrGduOYW.js";import"./WpTable.EicK-ih4.js";import"./ScoreButton.Di04Mqf2.js";import"./Table.B2KnjpXq.js";import"./Tooltip.DcUmvaHX.js";import"./LicenseConditions.YKPkrz3j.js";import"./_arrayEach.Fgt6pfHj.js";import"./vue.esm-bundler.v8OKKE5o.js";import"./IndexStatus.DWPPjohw.js";import"./PostTypes.Cef6XkQ_.js";import"./RequiredPlans.BWoa4M_T.js";import"./Card.C6Yzm1Gr.js";import"./Overview.BnN5s2e9.js";import"./DonutChartWithLegend.BDrgOxPz.js";import"./KeywordsGraph.Bt9ueMhV.js";import"./SeoStatisticsOverview.KbbpDN60.js";import"./List.Dw8hZraa.js";import"./Statistics.CP5lE97B.js";const V={setup(){return{optionsStore:b(),searchStatisticsStore:C()}},components:{CoreAlert:B},data(){return{error:this.$t.__("Your connection with Google Search Console has expired or is invalid. Please check that your site is verified in Google Search Console and try to reconnect. If the problem persists, please contact our support team.",this.$td)}},computed:{invalidAuthentication(){var t,s;return this.searchStatisticsStore.unverifiedSite||typeof((s=(t=this.optionsStore.internalOptions.internal)==null?void 0:t.searchStatistics)==null?void 0:s.profile)!="object"}}};function G(t,s,i,f,a,e){const m=o("core-alert");return e.invalidAuthentication?(r(),l(m,{key:0,class:"aioseo-input-error aioseo-search-statistics-authentication-alert",type:"red"},{default:n(()=>[y("strong",null,d(a.error),1)]),_:1})):u("",!0)}const U=h(V,[["render",G]]),E={};function F(t,s){return r(),_("div")}const I=h(E,[["render",F]]),z={};function H(t,s){return r(),_("div")}const j=h(z,[["render",H]]),q={setup(){return{licenseStore:L(),searchStatisticsStore:C()}},emits:["rolling"],components:{AuthenticationAlert:U,BaseDatePicker:M,CoreBlur:T,CoreMain:A,ContentRankings:O,Cta:J,Dashboard:R,KeywordRankings:N,PostDetail:I,Settings:j,SeoStatistics:P},data(){return{maxDate:null,minDate:null,loadingConnect:!1,strings:{pageName:this.$t.__("Search Statistics",this.$td),ctaHeaderText:this.$t.__("Connect your website to Google Search Console",this.$td),ctaDescription:this.$t.__("Connect your site to Google Search Console to receive insights on how content is being discovered. Identify areas for improvement and drive traffic to your website.",this.$td),ctaButtonText:this.$t.__("Connect to Google Search Console",this.$td),feature1:this.$t.__("Search traffic insights",this.$td),feature2:this.$t.__("Improved visibility",this.$td),feature3:this.$t.__("Track page and keyword rankings",this.$td),feature4:this.$t.__("Speed tests for individual pages/posts",this.$td)}}},computed:{defaultRange(){const t=new Date(`${this.searchStatisticsStore.range.start} 00:00:00`),s=new Date(`${this.searchStatisticsStore.range.end} 00:00:00`);return[t,s]},excludeTabs(){const t=["post-detail"];return(this.licenseStore.isUnlicensed||!g.hasCoreFeature("search-statistics"))&&t.push("settings"),t},isSettings(){return this.$route.name==="settings"},showConnectCta(){return(g.hasCoreFeature("search-statistics")&&!this.searchStatisticsStore.isConnected||this.searchStatisticsStore.unverifiedSite)&&!this.isSettings},showDatePicker(){return!["settings","content-rankings"].includes(this.$route.name)&&this.searchStatisticsStore.isConnected&&!this.searchStatisticsStore.unverifiedSite},containerClasses(){const t=[];return this.searchStatisticsStore.fetching&&t.push("aioseo-blur"),t},getOriginalMaxDate(){return this.searchStatisticsStore.latestAvailableDate?c.fromFormat(this.searchStatisticsStore.latestAvailableDate,"yyyy-MM-dd").setZone(c.zone)||c.local().plus({days:-2}):c.local().plus({days:-2})},datepickerShortcuts(){return[{text:this.$t.__("Last 7 Days",this.$td),value:()=>(window.aioseoBus.$emit("rolling","last7Days"),[this.getOriginalMaxDate.plus({days:-6}).toJSDate(),this.getOriginalMaxDate.toJSDate()])},{text:this.$t.__("Last 28 Days",this.$td),value:()=>(window.aioseoBus.$emit("rolling","last28Days"),[this.getOriginalMaxDate.plus({days:-27}).toJSDate(),this.getOriginalMaxDate.toJSDate()])},{text:this.$t.__("Last 3 Months",this.$td),value:()=>(window.aioseoBus.$emit("rolling","last3Months"),[this.getOriginalMaxDate.plus({days:-89}).toJSDate(),this.getOriginalMaxDate.toJSDate()])}]}},methods:{isDisabledDate(t){return this.minDate===null?!0:t.getTime()<this.minDate.getTime()||t.getTime()>this.maxDate.getTime()},onDateChange(t,s){this.searchStatisticsStore.setDateRange({dateRange:t,rolling:s})},connect(){this.loadingConnect=!0,this.searchStatisticsStore.getAuthUrl().then(t=>{window.location=t})},highlightShortcut(t){if(!t)return;document.querySelectorAll(".el-picker-panel__shortcut").forEach(i=>{switch(i.innerText){case this.$t.__("Last 7 Days",this.$td):t==="last7Days"?i.classList.add("active"):i.classList.remove("active");break;case this.$t.__("Last 28 Days",this.$td):t==="last28Days"?i.classList.add("active"):i.classList.remove("active");break;case this.$t.__("Last 3 Months",this.$td):t==="last3Months"?i.classList.add("active"):i.classList.remove("active");break;case this.$t.__("Last 6 Months",this.$td):t==="last6Months"?i.classList.add("active"):i.classList.remove("active");break;default:i.classList.remove("active")}})}},mounted(){this.minDate=c.now().plus({months:-16}).toJSDate(),this.maxDate=this.getOriginalMaxDate.toJSDate()}},K={key:0,class:"connect-cta"};function Y(t,s,i,f,a,e){const m=o("base-date-picker"),v=o("authentication-alert"),x=o("core-blur"),$=o("cta"),k=o("core-main");return r(),l(k,{"page-name":a.strings.pageName,"exclude-tabs":e.excludeTabs,showTabs:!e.excludeTabs.includes(t.$route.name),containerClasses:e.containerClasses},{extra:n(()=>[e.showDatePicker?(r(),l(m,{key:0,onChange:e.onDateChange,onUpdated:s[0]||(s[0]=w=>e.highlightShortcut(w)),clearable:!1,defaultValue:e.defaultRange,defaultRolling:f.searchStatisticsStore.rolling,isDisabledDate:e.isDisabledDate,shortcuts:e.datepickerShortcuts,size:"small"},null,8,["onChange","defaultValue","defaultRolling","isDisabledDate","shortcuts"])):u("",!0)]),default:n(()=>[y("div",null,[p(v),e.showConnectCta?(r(),_("div",K,[p(x,null,{default:n(()=>[(r(),l(S(t.$route.name)))]),_:1}),p($,{"cta-button-action":"",onCtaButtonClick:e.connect,"cta-button-loading":a.loadingConnect,"show-link":!1,"button-text":a.strings.ctaButtonText,alignTop:!0,hideBonus:!0,"feature-list":[a.strings.feature1,a.strings.feature2,a.strings.feature3,a.strings.feature4]},{"header-text":n(()=>[D(d(a.strings.ctaHeaderText),1)]),description:n(()=>[D(d(a.strings.ctaDescription),1)]),_:1},8,["onCtaButtonClick","cta-button-loading","button-text","feature-list"])])):u("",!0),e.showConnectCta?u("",!0):(r(),l(S(t.$route.name),{key:1}))])]),_:1},8,["page-name","exclude-tabs","showTabs","containerClasses"])}const ne=h(q,[["render",Y]]);export{ne as default};
