jQuery(function(){
    var c = [].slice.call(document.querySelectorAll(".image-highlight-cta-module__card"));
    c.forEach(function(p) {
        p.style.transform = ["translate3d(-", 50 - 10 + Math.random() * 20, "%, -", 50 - 10 + Math.random() * 20, "%, 0) rotateY(", -20 + Math.random() * 40, "deg) rotateX(", -20 + Math.random() * 40, "deg) scale(.9)"].join("")
    });
    var d = document.querySelector(".image-highlight-cta-module");
    var f = document.querySelector(".image-highlight-cta-module__card-container");
    var o = null;
    var b = -1;
    var h = 2000;
    var k = null;

    function l() {
        b++;
        if (b >= c.length) {
            b = 0
        }
        g(b);
        k = setTimeout(l, h)
    }

    function g(p) {
        if (o) {
            o.classList.remove("active")
        }
        o = c[p];
        o && o.classList.add("active")
    }
    var m = {
        x: window.innerWidth / 2,
        y: window.innerHeight * 0.8 / 2
    };
    var n = {
        x: 0,
        y: 0
    };
    var j = {
        x: 0,
        y: 0,
        toX: 0,
        toY: 0
    };
    var e = false;
    d && d.addEventListener("mousemove", function(q) {
        e = true;
        clearTimeout(k);
        k = setTimeout(l, 5000);
        var p = Math.floor((q.clientX / window.innerWidth) * c.length);
        b = p;
        m.x = q.clientX;
        m.y = q.clientY;
        g(p)
    });
    d && d.addEventListener("mouseout", function() {
        e = false;
        n.x = 0;
        n.y = 0
    });

    function i() {
        if (!f) {
            return;
        }
        requestAnimationFrame(i);
        var p = f.getBoundingClientRect();
        if (e) {
            n.x = (m.x + p.left) / (p.width) - 0.5;
            n.y = (m.y + p.top) / (p.height) - 0.5
        }
        j.toX = window.innerWidth * 0.2 - n.x * 200;
        j.toY = window.innerHeight * 0.05 - n.y * 200;
        j.x += (j.toX - j.x) * 0.04;
        j.y += (j.toY - j.y) * 0.04;
        f.style.transform = ["translate(", j.x, "px, ", j.y, "px)"].join("")
    }
    i();
    l();
});