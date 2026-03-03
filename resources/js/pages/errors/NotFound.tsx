import { useEffect, useState } from "react";
import { motion } from "framer-motion";

export default function NotFound() {
    const [seconds, setSeconds] = useState(5);

    useEffect(() => {
        const timer = setInterval(() => {
            setSeconds((prev) => prev - 1);
        }, 1000);

        const redirect = setTimeout(() => {
            window.location.href = "/";
        }, 5000);

        return () => {
            clearInterval(timer);
            clearTimeout(redirect);
        };
    }, []);

    return (
        <div className="flex min-h-screen items-center justify-center bg-slate-950 text-white px-6">
            <motion.div
                initial={{ opacity: 0, scale: 0.95 }}
                animate={{ opacity: 1, scale: 1 }}
                transition={{ duration: 0.6 }}
                className="text-center"
            >
                <motion.h1
                    initial={{ y: -20, opacity: 0 }}
                    animate={{ y: 0, opacity: 1 }}
                    transition={{ delay: 0.2 }}
                    className="text-7xl font-bold"
                >
                    404
                </motion.h1>

                <motion.p
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    transition={{ delay: 0.4 }}
                    className="mt-6 text-lg text-slate-300"
                >
                    Page not found.
                </motion.p>

                <motion.p
                    initial={{ opacity: 0 }}
                    animate={{ opacity: 1 }}
                    transition={{ delay: 0.6 }}
                    className="mt-4 text-sm text-slate-400"
                >
                    Redirecting to home in{" "}
                    <span className="font-semibold text-white">
                        {seconds}
                    </span>{" "}
                    seconds...
                </motion.p>

                <motion.a
                    href="/"
                    whileHover={{ scale: 1.05 }}
                    className="inline-block mt-8 rounded-lg bg-white px-6 py-3 text-black transition"
                >
                    Go Home Now
                </motion.a>
            </motion.div>
        </div>
    );
}