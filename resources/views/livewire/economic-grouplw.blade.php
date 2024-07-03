<div 
    x-data="{
        theme: null,
        init: function () {
            this.theme = localStorage.getItem('theme') || 'dark'
            this.changeTheme(this.theme)
        },
        changeTheme: function(theme) {
            this.theme = theme
            localStorage.setItem('theme', theme)
            document.documentElement.className = theme
        }
    }"
>
    <main class="wrapper w-full md:max-w-5xl mx-auto pt-20 px-4">
        <section class="pt-4">
            {{ $this->table }}
        </section>
    </main>
</div>