"use strict";
let direction = "ltr";
isRtl && (direction = "rtl"), document.addEventListener("DOMContentLoaded", function () {
    {
        const x = document.getElementById("calendar"), q = document.querySelector(".app-calendar-sidebar"),
            D = document.getElementById("addEventSidebar"), P = document.querySelector(".app-overlay"),
            M = {Business: "primary", Holiday: "success", Personal: "danger", Family: "warning", ETC: "info"},
            t = document.querySelector(".offcanvas-title"), T = document.querySelector(".btn-toggle-sidebar"),
            n = document.querySelector(".btn-add-event"), d = document.querySelector(".btn-update-event"),
            o = document.querySelector(".btn-delete-event"), A = document.querySelector(".btn-cancel"),
            F = document.querySelector("#eventTitle"), s = document.querySelector("#eventStartDate"),
            c = document.querySelector("#eventEndDate"), Y = document.querySelector("#eventURL"), u = $("#eventLabel"),
            v = $("#eventGuests"), C = document.querySelector("#eventLocation"),
            V = document.querySelector("#eventDescription"), m = document.querySelector(".allDay-switch"),
            B = document.querySelector(".select-all"), I = [].slice.call(document.querySelectorAll(".input-filter")),
            R = document.querySelector(".inline-calendar");
        let a, l = events, r = !1, e;
        const p = new bootstrap.Offcanvas(D);

        function f(e) {
            return e.id ? "<span class='badge badge-dot bg-" + $(e.element).data("label") + " me-2'> </span>" + e.text : e.text
        }

        function g(e) {
            return e.id ? "<div class='d-flex flex-wrap align-items-center'><div class='avatar avatar-xs me-2'><img src='" + assetsPath + "img/avatars/" + $(e.element).data("avatar") + "' alt='avatar' class='rounded-circle' /></div>" + e.text + "</div>" : e.text
        }

        var h, b;

        function y() {
            const e = document.querySelector(".fc-sidebarToggle-button");
            for (e.classList.remove("fc-button-primary"), e.classList.add("d-lg-none", "d-inline-block", "ps-0"); e.firstChild;) e.firstChild.remove();
            e.setAttribute("data-bs-toggle", "sidebar"), e.setAttribute("data-overlay", ""), e.setAttribute("data-target", "#app-calendar-sidebar"), e.insertAdjacentHTML("beforeend", '<i class="bx bx-menu bx-sm text-body"></i>')
        }

        u.length && u.wrap('<div class="position-relative"></div>').select2({
            placeholder: "Select value",
            dropdownParent: u.parent(),
            templateResult: f,
            templateSelection: f,
            minimumResultsForSearch: -1,
            escapeMarkup: function (e) {
                return e
            }
        }), v.length && v.wrap('<div class="position-relative"></div>').select2({
            placeholder: "Select value",
            dropdownParent: v.parent(),
            closeOnSelect: !1,
            templateResult: g,
            templateSelection: g,
            escapeMarkup: function (e) {
                return e
            }
        }), s && (h = s.flatpickr({
            enableTime: !0, altFormat: "Y-m-dTH:i:S", onReady: function (e, t, n) {
                n.isMobile && n.mobileInput.setAttribute("step", null)
            }
        })), c && (b = c.flatpickr({
            enableTime: !0, altFormat: "Y-m-dTH:i:S", onReady: function (e, t, n) {
                n.isMobile && n.mobileInput.setAttribute("step", null)
            }
        })), R && (e = R.flatpickr({monthSelectorType: "static", inline: !0}));
        var {dayGrid: S, interaction: L, timeGrid: E, list: k} = calendarPlugins;
        let i = new Calendar(x, {
            locale: 'pt-br',
            initialView: "dayGridMonth",
            events: function (e, t) {
                let n = function () {
                    let t = [], e = [].slice.call(document.querySelectorAll(".input-filter:checked"));
                    return e.forEach(e => {
                        t.push(e.getAttribute("data-value"))
                    }), t
                }();
                t(l.filter(function (e) {
                    return n.includes(e.extendedProps.calendar.toLowerCase())
                }))
            },
            plugins: [L, S, E, k],
            editable: !0,
            dragScroll: !0,
            dayMaxEvents: 2,
            eventResizableFromStart: !0,
            customButtons: {sidebarToggle: {text: "Sidebar"}},
            headerToolbar: {
                start: "sidebarToggle, prev,next, title",
                end: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
            },
            direction: direction,
            initialDate: new Date,
            navLinks: !0,
            eventClassNames: function ({event: e}) {
                return ["fc-event-" + M[e._def.extendedProps.calendar]]
            },
            dateClick: function (e) {
                e = moment(e.date).format("YYYY-MM-DD");
                w(), p.show(), t && (t.innerHTML = "Add Event"), n.classList.remove("d-none"), d.classList.add("d-none"), o.classList.add("d-none"), s.value = e, c.value = e
            },
            eventClick: function (e) {
                e = e, (a = e.event).url && (e.jsEvent.preventDefault(), window.open(a.url, "_blank")), p.show(), n.classList.add("d-none"), d.classList.remove("d-none"), t && (t.innerHTML = "Update Event"), o.classList.remove("d-none"), F.value = a.title, h.setDate(a.start, !0, "Y-m-d"), !0 === a.allDay ? m.checked = !0 : m.checked = !1, null !== a.end ? b.setDate(a.end, !0, "Y-m-d") : b.setDate(a.start, !0, "Y-m-d"), u.val(a.extendedProps.calendar).trigger("change"), void 0 !== a.extendedProps.location && (C.value = a.extendedProps.location), void 0 !== a.extendedProps.guests && v.val(a.extendedProps.guests).trigger("change"), void 0 !== a.extendedProps.description && (V.value = a.extendedProps.description)
            },
            datesSet: function () {
                y()
            },
            viewDidMount: function () {
                y()
            }
        });

        function w() {
            c.value = "", Y.value = "", s.value = "", F.value = "", C.value = "", m.checked = !1, v.val("").trigger("change"), V.value = ""
        }

        return i.render(), y(), L = document.getElementById("eventForm"), FormValidation.formValidation(L, {
            fields: {
                eventTitle: {validators: {notEmpty: {message: "Please enter event title "}}},
                eventStartDate: {validators: {notEmpty: {message: "Please enter start date "}}},
                eventEndDate: {validators: {notEmpty: {message: "Please enter end date "}}}
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger,
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: "", rowSelector: function (e, t) {
                        return ".mb-3"
                    }
                }),
                submitButton: new FormValidation.plugins.SubmitButton,
                autoFocus: new FormValidation.plugins.AutoFocus
            }
        }).on("core.form.valid", function () {
            r = !0
        }), T && T.addEventListener("click", e => {
            A.classList.remove("d-none")
        }), n.addEventListener("click", e => {
            if (r) {
                let e = {
                    id: i.getEvents().length + 1,
                    title: F.value,
                    start: s.value,
                    end: c.value,
                    startStr: s.value,
                    endStr: c.value,
                    display: "block",
                    extendedProps: {location: C.value, guests: v.val(), calendar: u.val(), description: V.value}
                };
                Y.value && (e.url = Y.value), m.checked && (e.allDay = !0), t = e, l.push(t), i.refetchEvents(), p.hide()
            }
            var t
        }), d.addEventListener("click", e => {
            var t, n;
            r && (t = {
                id: a.id,
                title: F.value,
                start: s.value,
                end: c.value,
                url: Y.value,
                extendedProps: {location: C.value, guests: v.val(), calendar: u.val(), description: V.value},
                display: "block",
                allDay: !!m.checked
            }, (n = t).id = parseInt(n.id), l[l.findIndex(e => e.id === n.id)] = n, i.refetchEvents(), p.hide())
        }), o.addEventListener("click", e => {
            var t;
            t = parseInt(a.id), l = l.filter(function (e) {
                return e.id != t
            }), i.refetchEvents(), p.hide()
        }), D.addEventListener("hidden.bs.offcanvas", function () {
            w()
        }), T.addEventListener("click", e => {
            o.classList.add("d-none"), d.classList.add("d-none"), n.classList.remove("d-none"), q.classList.remove("show"), P.classList.remove("show")
        }), B && B.addEventListener("click", e => {
            e.currentTarget.checked ? document.querySelectorAll(".input-filter").forEach(e => e.checked = 1) : document.querySelectorAll(".input-filter").forEach(e => e.checked = 0), i.refetchEvents()
        }), I && I.forEach(e => {
            e.addEventListener("click", () => {
                document.querySelectorAll(".input-filter:checked").length < document.querySelectorAll(".input-filter").length ? B.checked = !1 : B.checked = !0, i.refetchEvents()
            })
        }), void e.config.onChange.push(function (e) {
            i.changeView(i.view.type, moment(e[0]).format("YYYY-MM-DD")), y(), q.classList.remove("show"), P.classList.remove("show")
        })
    }
});