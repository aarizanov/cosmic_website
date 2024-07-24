import{o as m,c as w,y as s,l as _,m as r,a as c,E as p,t as a,D as i,d as S}from"./vue.esm-bundler.DzelZkHk.js";import{_ as g}from"./_plugin-vue_export-helper.BN1snXvA.js";import{f as x}from"./links.CKSg78-h.js";import{_ as n,s as v}from"./default-i18n.BtxsUzQk.js";import{C as $}from"./Blur.B433XVqJ.js";import{C as B}from"./SettingsRow.B0N4hwjp.js";import{S as A}from"./External.bx7ZSfw_.js";import{B as G}from"./Checkbox.CfGJSeWE.js";import{C as D}from"./Card.C6Yzm1Gr.js";import{C as M}from"./ProBadge.Dgq0taM8.js";import{C as R}from"./Index.Ck0NNxBQ.js";import{R as H}from"./RequiredPlans.BWoa4M_T.js";import{A as I}from"./AddonConditions.CQeNF7DC.js";import"./isArrayLikeObject.CkjpbQo7.js";import"./Row.ou4tdPuA.js";import"./Checkmark.Du5wcsnR.js";import"./Tooltip.DcUmvaHX.js";import"./Caret.Cuasz9Up.js";import"./index.DX4OhBfI.js";import"./Slide.BfXXFx9A.js";import"./constants.DARe-ccJ.js";import"./addons.Bhqo_sme.js";import"./upperFirst.Cx8cdEgZ.js";import"./_stringToArray.DnK4tKcY.js";import"./toString.EVG10Qqs.js";import"./license.8zyTf6Rb.js";const o="all-in-one-seo-pack",L=()=>({strings:{news:n("News Sitemap",o),setPublicationName:n("Set Publication Name",o),publicationName:n("Publication Name",o),postTypes:n("Post Types",o),exclude:n("Exclude Pages/Posts",o),description:n("The Google News Sitemap lets you control which content you submit to Google News and only contains articles that were published in the last 48 hours.",o),extendedDescription:n("In order to submit a News Sitemap to Google, you must have added your site to Google’s Publisher Center and had it approved.",o),enableSitemap:n("Enable Sitemap",o),openSitemap:n("Open News Sitemap",o),noIndexDisplayed:n("Noindexed content will not be displayed in your sitemap.",o),doYou404:n("Do you get a blank sitemap or 404 error?",o),ctaButtonText:n("Unlock News Sitemaps",o),ctaHeader:v(n("News Sitemaps is a %1$s Feature",o),"PRO"),includeAllPostTypes:n("Include All Post Types",o),selectPostTypes:n("Select which Post Types appear in your sitemap.",o)}}),U={};function O(e,f){return m(),w("div")}const E=g(U,[["render",O]]),V={setup(){const{strings:e}=L();return{strings:e}},components:{CoreBlur:$,CoreSettingsRow:B,SvgExternal:A,BaseCheckbox:G}},q={class:"aioseo-settings-row aioseo-section-description"},z=["innerHTML"],Y={class:"aioseo-sitemap-preview"},F={class:"aioseo-description"},j=c("br",null,null,-1),J=["innerHTML"],K={class:"aioseo-description"},Q=["innerHTML"];function W(e,f,y,t,N,k){const d=s("base-toggle"),l=s("core-settings-row"),u=s("svg-external"),h=s("base-button"),b=s("base-input"),P=s("base-checkbox"),C=s("core-blur");return m(),_(C,null,{default:r(()=>[c("div",q,[p(a(t.strings.description)+" "+a(t.strings.extendedDescription)+" ",1),c("span",{innerHTML:e.$links.getDocLink(e.$constants.GLOBAL_STRINGS.learnMore,"newsSitemaps",!0)},null,8,z)]),i(l,{name:t.strings.enableSitemap},{content:r(()=>[i(d,{modelValue:!0})]),_:1},8,["name"]),i(l,{name:e.$constants.GLOBAL_STRINGS.preview},{content:r(()=>[c("div",Y,[i(h,{size:"medium",type:"blue"},{default:r(()=>[i(u),p(" "+a(t.strings.openSitemap),1)]),_:1})]),c("div",F,[p(a(t.strings.noIndexDisplayed)+" ",1),j,p(" "+a(t.strings.doYou404)+" ",1),c("span",{innerHTML:e.$links.getDocLink(e.$constants.GLOBAL_STRINGS.learnMore,"blankSitemap",!0)},null,8,J)])]),_:1},8,["name"]),i(l,{name:t.strings.publicationName,align:""},{content:r(()=>[i(b,{size:"medium"})]),_:1},8,["name"]),i(l,{name:t.strings.postTypes},{content:r(()=>[i(P,{size:"medium"},{default:r(()=>[p(a(t.strings.includeAllPostTypes),1)]),_:1}),c("div",K,[p(a(t.strings.selectPostTypes)+" ",1),c("span",{innerHTML:e.$links.getDocLink(e.$constants.GLOBAL_STRINGS.learnMore,"selectPostTypesNews",!0)},null,8,Q)])]),_:1},8,["name"])]),_:1})}const X=g(V,[["render",W]]),Z={setup(){const{strings:e}=L();return{licenseStore:x(),strings:e}},components:{Blur:X,CoreCard:D,CoreProBadge:M,Cta:R,RequiredPlans:H}},ee={class:"aioseo-news-sitemap-lite"};function te(e,f,y,t,N,k){const d=s("core-pro-badge"),l=s("blur"),u=s("required-plans"),h=s("cta"),b=s("core-card");return m(),w("div",ee,[i(b,{slug:"newsSitemap",noSlide:!0},{header:r(()=>[c("span",null,a(t.strings.news),1),i(d)]),default:r(()=>[i(l),i(h,{"feature-list":[t.strings.setPublicationName,t.strings.exclude],"cta-link":e.$links.getPricingUrl("news-sitemap","news-sitemap-upsell"),"button-text":t.strings.ctaButtonText,"learn-more-link":e.$links.getUpsellUrl("news-sitemap",null,e.$isPro?"pricing":"liteUpgrade"),"hide-bonus":!t.licenseStore.isUnlicensed},{"header-text":r(()=>[p(a(t.strings.ctaHeader),1)]),description:r(()=>[i(u,{addon:"aioseo-news-sitemap"}),p(" "+a(t.strings.description),1)]),_:1},8,["feature-list","cta-link","button-text","learn-more-link","hide-bonus"])]),_:1})])}const T=g(Z,[["render",te]]),ne={mixins:[I],components:{Cta:E,Lite:T,NewsSitemap:T},data(){return{addonSlug:"aioseo-news-sitemap"}}},oe={class:"aioseo-news-sitemap"};function se(e,f,y,t,N,k){const d=s("news-sitemap",!0),l=s("cta"),u=s("lite");return m(),w("div",oe,[e.shouldShowMain?(m(),_(d,{key:0})):S("",!0),e.shouldShowUpdate||e.shouldShowActivate?(m(),_(l,{key:1})):S("",!0),e.shouldShowLite?(m(),_(u,{key:2})):S("",!0)])}const Be=g(ne,[["render",se]]);export{Be as default};
