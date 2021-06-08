/*
 * Better File Input 1.3.0 (https://github.com/nifte/better-file-input)
 * by nifte (https://github.com/nifte)
 * Licensed under MIT (https://github.com/nifte/better-file-input/blob/master/LICENSE)
 */
const style = "@-webkit-keyframes file_grow{0%{max-height:0;padding:0 10px}100%{max-height:100px}}@keyframes file_grow{0%{max-height:0;padding:0 10px}100%{max-height:100px}}@-webkit-keyframes shadow_grow{0%{-webkit-transform:scale(0);transform:scale(0)}100%{-webkit-transform:scale(1);transform:scale(1)}}@keyframes shadow_grow{0%{-webkit-transform:scale(0);transform:scale(0)}100%{-webkit-transform:scale(1);transform:scale(1)}}.bfi-container{display:block;position:relative;width:100%;height:unset;margin:0;padding:0;border-radius:5px;background:#f0f0f0;-webkit-box-sizing:border-box;box-sizing:border-box;-webkit-transition:max-height 1s ease;transition:max-height 1s ease}.bfi-container.expanded{border:4px dashed gray}.bfi-container *{-webkit-box-sizing:border-box;box-sizing:border-box}.bfi-converted,.bfi-converted-multi{opacity:0;position:absolute;top:0;left:0;width:100%;height:100%}.bfi-container:not(.expanded) .bfi-converted,.bfi-container:not(.expanded) .bfi-converted-multi{z-index:-10}.bfi-container.expanded .bfi-converted,.bfi-container.expanded .bfi-converted-multi{z-index:20}.bfi-label,.bfi-label-selected{display:inline-block;width:100%;height:unset;margin:0;text-align:center;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;z-index:10}.bfi-container:not(.expanded) .bfi-label,.bfi-label-selected{padding:10px 20px}.bfi-container.expanded .bfi-label{padding:40px 20px}.bfi-label{-webkit-transition:padding .25s ease;transition:padding .25s ease}.bfi-clear,.bfi-label span{cursor:pointer;text-decoration:underline}.bfi-file{display:inline-block;width:-o-calc(100% - 20px);width:calc(100% - 20px);padding:6px 10px;background:#646464;background:-webkit-gradient(linear,left bottom,left top,from(rgba(90,90,90,1)),color-stop(75%,rgba(110,110,110,1)));background:linear-gradient(0deg,rgba(90,90,90,1) 0,rgba(110,110,110,1) 75%);color:#fff;border-radius:7px;z-index:10;line-height:1em;-webkit-animation:file_grow .7s ease;animation:file_grow .7s ease}.bfi-converted~.bfi-file{margin:10px}.bfi-converted-multi~.bfi-file{margin:0 10px 10px 10px}.bfi-file i{font-style:normal;font-size:.8em;color:#b4b4b4}.bfi-file .bfi-clear{position:absolute;right:25px;top:calc(50% - 2px);-webkit-transform:translateY(-50%);transform:translateY(-50%);-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.bfi-shadow-container{position:absolute;display:none;margin:0;padding:0;left:0;right:0;top:0;bottom:0;clip:rect(0,auto,auto,0);z-index:15}.bfi-container.expanded .bfi-shadow-container{display:unset}.bfi-shadow{position:absolute;display:none;width:350px;height:350px;border-radius:50%;background:rgba(0,0,0,.06);-webkit-transition:left .1s ease,top .1s ease;transition:left .1s ease,top .1s ease}.bfi-container.hovering .bfi-shadow{display:unset;-webkit-animation:shadow_grow .5s ease;animation:shadow_grow .5s ease}";
var bfi_drag_timeout, bfi_hover_timeout, bfi_counter = 0;

function bfi_init(e = null) {
    document.querySelectorAll(".bfi-style").length < 1 && document.body.insertAdjacentHTML("beforeend", `<style class="bfi-style">${style}</style>`);
    let t = document.querySelectorAll('input[type="file"].bfi'),
        i = t.length;
    for (let e = 0; e < i; e++) {
        bfi_counter++;
        let i = t[e],
            n = document.createElement("div"),
            a = "";
        i.parentElement.insertBefore(n, i), n.appendChild(i), n.classList.add("bfi-container"), i.hasAttribute("multiple") ? (i.classList.add("bfi-converted-multi"), n.insertAdjacentHTML("beforeend", '<div class="bfi-label-selected" style="display: none;"></div>'), a = "Arrastra el contenido, o <span>Examina</span>") : (i.classList.add("bfi-converted"), a = "Arrastra el contenido, o <span>Examina</span>"), i.hasAttribute("id") || i.setAttribute("id", `bfi-${bfi_counter}`);
        let r = i.getAttribute("id");
        n.insertAdjacentHTML("afterbegin", `<label class="bfi-label" for="${r}" tabindex="0">${a}</label>`), n.insertAdjacentHTML("beforeend", '<div class="bfi-shadow-container"><div class="bfi-shadow"></div></div>'), i.setAttribute("tabindex", -1)
    }
    if (document.querySelectorAll('input[type="file"].bfi').forEach(e => { e.classList.remove("bfi") }), null != e) {
        let t = "";
        e.hasOwnProperty("labelColor") && (t += `.bfi-label, .bfi-label-selected { color: ${e.labelColor} }`), e.hasOwnProperty("containerColor") && (t += `.bfi-container { background: ${e.containerColor} }`), e.hasOwnProperty("fileColor") && (t += `.bfi-file { background: ${e.fileColor} }`), e.hasOwnProperty("fileNameColor") && (t += `.bfi-file { color: ${e.fileNameColor} }`), e.hasOwnProperty("fileInfoColor") && (t += `.bfi-file i { color: ${e.fileInfoColor} }`), e.hasOwnProperty("dragDropBorder") && (t += `.bfi-container.expanded { border: ${e.dragDropBorder} }`), document.body.insertAdjacentHTML("beforeend", `<style class="bfi-style-override">${t}</style>`)
    }
}

function bfi_reset() {
    let e = document.querySelectorAll(".bfi-style-override");
    e.length && e.forEach(e => { e.remove() })
}

function bfi_clear(e = null) {
    null == e && (e = ".bfi-converted, .bfi-converted-multi");
    let t = document.querySelectorAll(e);
    t.length && t.forEach(e => { e.value = "", e.dispatchEvent(new Event("change", { bubbles: !0 })) })
}
document.addEventListener("DOMContentLoaded", () => { bfi_init() }), window.addEventListener("dragover", e => {
    let t = e.dataTransfer;
    if (t.types && (t.types.indexOf ? -1 != t.types.indexOf("Files") : t.types.contains("Files")) && (document.querySelectorAll(".bfi-container").forEach(e => { "none" != e.querySelector(".bfi-label").style.display && e.classList.add("expanded") }), clearTimeout(bfi_drag_timeout), bfi_drag_timeout = setTimeout(() => { document.querySelectorAll(".bfi-container").forEach(e => { e.classList.remove("expanded") }) }, 100), document.querySelectorAll(".bfi-shadow").forEach(t => {
            let i = t.closest(".bfi-shadow-container").getBoundingClientRect(),
                n = Number(.75 * i.width).toFixed();
            n > 500 && (n = 500), t.style.width = n + "px", t.style.height = n + "px", t.style.left = Number(e.pageX - i.left - n / 2).toFixed() + "px", t.style.top = Number(e.pageY - i.top - n / 2).toFixed() + "px"
        }), e.target.classList.contains("bfi-converted") || e.target.classList.contains("bfi-converted-multi"))) {
        let t = e.target.closest(".bfi-container");
        t.classList.add("hovering"), clearTimeout(bfi_hover_timeout), bfi_hover_timeout = setTimeout(() => { t.classList.remove("hovering") }, 100)
    }
}), window.addEventListener("dragleave", e => { if (e.target.classList.contains("bfi-converted") || e.target.classList.contains("bfi-converted-multi")) { e.target.closest(".bfi-container").classList.remove("hovering") } }), window.addEventListener("dragover", e => { e.target.classList.contains("bfi-converted") || e.target.classList.contains("bfi-converted-multi") || (e.preventDefault(), e.dataTransfer.effectAllowed = "none", e.dataTransfer.dropEffect = "none") }), window.addEventListener("drop", e => { e.target.classList.contains("bfi-converted") || e.target.classList.contains("bfi-converted-multi") || (e.preventDefault(), e.dataTransfer.effectAllowed = "none", e.dataTransfer.dropEffect = "none") }), document.addEventListener("change", e => {
    if (e.target.classList.contains("bfi-converted")) {
        let t = e.target.closest(".bfi-container");
        if (e.target.files.length) {
            t.querySelector(".bfi-label").style.display = "none", t.querySelectorAll(".bfi-file").forEach(e => { e.remove() });
            let i = e.target.files[0].name,
                n = Number(e.target.files[0].size / 1e3).toFixed(1) + " KB";
            t.insertAdjacentHTML("beforeend", `<div class="bfi-file"><span class="bfi-clear" tabindex="0" style="color:white">Deshacer</span>${i}<br><i>${n}</i></div>`)
        } else t.querySelector(".bfi-label").style.display = "", t.querySelectorAll(".bfi-file").forEach(e => { e.remove() })
    }
    if (e.target.classList.contains("bfi-converted-multi")) {
        let t = e.target.closest(".bfi-container");
        if (e.target.files.length) {
            t.querySelector(".bfi-label").style.display = "none", t.querySelector(".bfi-label-selected").style.display = "", t.querySelectorAll(".bfi-file").forEach(e => { e.remove() });
            let i = [];
            for (let t = 0; t < e.target.files.length; t++) i.push({ name: e.target.files[t].name, size: Number(e.target.files[t].size / 1e3).toFixed(1) + " KB" });
            let n = "1 archivo";
            i.length > 1 && (n = `${i.length} archivos`), t.querySelector(".bfi-label-selected").innerHTML = `${n} seleccionado/s. <span class="bfi-clear" tabindex="0">Deshacer</span>`, i.forEach(e => { t.insertAdjacentHTML("beforeend", `<div class="bfi-file">${e.name}<br><i>${e.size}</i></div>`) })
        } else t.querySelector(".bfi-label").style.display = "", t.querySelector(".bfi-label-selected").style.display = "none", t.querySelectorAll(".bfi-file").forEach(e => { e.remove() })
    }
}), document.addEventListener("keyup", e => { 32 != e.keyCode && 13 != e.keyCode || (document.activeElement.classList.contains("bfi-label") && document.activeElement.click(), document.activeElement.classList.contains("bfi-clear") && document.activeElement.click()) }), document.addEventListener("click", e => { if (e.target.classList.contains("bfi-clear")) { bfi_clear(`#${e.target.closest(".bfi-container").querySelector(".bfi-converted, .bfi-converted-multi").getAttribute("id")}`) } });