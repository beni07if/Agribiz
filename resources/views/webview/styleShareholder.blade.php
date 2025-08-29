<style>
    .futuristic-card {
        background: rgba(255, 255, 255, 0.07);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 20px;
        padding: 25px;
        text-align: center;
        backdrop-filter: blur(12px);
        box-shadow: 0 0 15px rgba(0, 183, 255, 0.25);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .futuristic-card::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: conic-gradient(from 180deg at 50% 50%, #00f7ff, #007bff, #00ffcc, #00f7ff);
        animation: rotate 6s linear infinite;
        opacity: 0.15;
    }

    @keyframes rotate {
        100% {
            transform: rotate(360deg);
        }
    }

    .futuristic-card:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 0 25px rgba(0, 183, 255, 0.5);
    }

    .futuristic-card .icon {
        font-size: 45px;
        margin-bottom: 15px;
        color: #00e0ff;
        text-shadow: 0 0 10px #00e0ff, 0 0 20px #00e0ff;
    }

    .futuristic-title {
        background: none;
        border: none;
        color: #fff;
        font-weight: 700;
        font-size: 20px;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .futuristic-title:hover {
        color: #00f7ff;
        text-shadow: 0 0 10px #00f7ff, 0 0 20px #00f7ff;
    }

    .futuristic-details {
        list-style: none;
        padding: 0;
        margin-top: 15px;
        color: #cce7ff;
        font-size: 14px;
        line-height: 1.6;
    }

    .futuristic-details strong {
        color: #fff;
    }

    .futuristic-card {
        background: rgba(255, 255, 255, 0.07);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 20px;
        padding: 25px;
        text-align: center;
        backdrop-filter: blur(12px);
        box-shadow: 0 0 15px rgba(0, 183, 255, 0.25);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .futuristic-card::before {
        content: "";
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: conic-gradient(from 180deg at 50% 50%, #00f7ff, #007bff, #00ffcc, #00f7ff);
        animation: rotate 6s linear infinite;
        opacity: 0.15;
    }

    @keyframes rotate {
        100% {
            transform: rotate(360deg);
        }
    }

    .futuristic-card:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 0 25px rgba(0, 183, 255, 0.5);
    }

    .futuristic-card .icon {
        font-size: 45px;
        margin-bottom: 15px;
        color: #00e0ff;
        text-shadow: 0 0 10px #00e0ff, 0 0 20px #00e0ff;
    }

    .futuristic-title {
        background: none;
        border: none;
        color: #fff;
        font-weight: 700;
        font-size: 20px;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .futuristic-title:hover {
        color: #00f7ff;
        text-shadow: 0 0 10px #00f7ff, 0 0 20px #00f7ff;
    }

    .futuristic-details {
        list-style: none;
        padding: 0;
        margin-top: 15px;
        color: #cce7ff;
        font-size: 14px;
        line-height: 1.6;
    }

    .futuristic-details strong {
        color: #fff;
    }
</style>