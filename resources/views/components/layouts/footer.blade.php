@props(['currentYear' => ''])

<footer class="footer">
    <div class="d-flex justify-content-end mb-2">
        <span class="text-sm-left d-block"><span class="footer-title">Kurta Experts </span> | © Copyright {{ $currentYear }}</span>
    </div>
    <div class="d-flex justify-content-end mb-3">
        <span class="version">{{ $version }}</span>
    </div>
    <div class="d-flex justify-content-end">
        <span class="version">Developed By: <a href="https://www.linkedin.com/in/faisal-mumtaz-0a97b31b2?utm_source=share_via&utm_content=profile&utm_medium=member_android" target="__blank" class="developer_link">Faisal Mumtaz Depar</a></span>
    </div>
</footer>