import './bootstrap';

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.cat').forEach(c=>{
        c.onclick=()=>{document.querySelectorAll('.cat').forEach(x=>x.classList.remove('on'));c.classList.add('on')}
    });
    document.querySelectorAll('.fltr').forEach(f=>{
        f.onclick=()=>{document.querySelectorAll('.fltr').forEach(x=>x.classList.remove('on'));f.classList.add('on')}
    });
    document.querySelectorAll('.bn').forEach(b=>{
        b.onclick=()=>{document.querySelectorAll('.bn').forEach(x=>x.classList.remove('on'));b.classList.add('on')}
    });
    document.querySelectorAll('.pcard').forEach(c=>{
        c.onmousedown=()=>c.style.transform='scale(.97)';
        c.onmouseup=()=>c.style.transform='';
        c.onmouseleave=()=>c.style.transform='';
    });
});
