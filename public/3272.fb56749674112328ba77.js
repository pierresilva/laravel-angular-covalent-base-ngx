(self.webpackChunkngxcovalent=self.webpackChunkngxcovalent||[]).push([[3272],{53272:(e,t,n)=>{"use strict";n.r(t),n.d(t,{createSwipeBackGesture:()=>s});var a=n(52377),r=n(39461);n(40960);const s=(e,t,n,s,c)=>{const o=e.ownerDocument.defaultView;return(0,r.createGesture)({el:e,gestureName:"goback-swipe",gesturePriority:40,threshold:10,canStart:e=>e.startX<=50&&t(),onStart:n,onMove:e=>{s(e.deltaX/o.innerWidth)},onEnd:e=>{const t=o.innerWidth,n=e.deltaX/t,r=e.velocityX,s=r>=0&&(r>.2||e.deltaX>t/2),i=(s?1-n:n)*t;let l=0;if(i>5){const e=i/Math.abs(r);l=Math.min(e,540)}c(s,n<=0?.01:(0,a.j)(0,n,.9999),l)}})}}}]);