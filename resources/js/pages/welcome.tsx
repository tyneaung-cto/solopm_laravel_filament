import { Head, Link, usePage } from '@inertiajs/react';
// import { dashboard, login, register } from '@/routes';
import type { SharedData } from '@/types';

import { motion } from 'framer-motion'

export default function Welcome({
    canRegister = true,
}: {
    canRegister?: boolean;
}) {
    const { auth } = usePage<SharedData>().props;

    return (
        <>
            <Head title="Welcome">
                <link rel="preconnect" href="https://fonts.bunny.net" />
                <link
                    href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600"
                    rel="stylesheet"
                />
            </Head>
            <div className="flex min-h-screen flex-col items-center bg-[#FDFDFC] text-[#1b1b18] dark:bg-[#0a0a0a]">
                <div className="flex w-full flex-col items-center justify-center lg:grow">

                    {/* HERO SECTION */}
                    <motion.section
                        initial={{ opacity: 0, y: 80 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ duration: 0.9, ease: [0.22, 1, 0.36, 1] }}
                        className="w-full py-32 bg-slate-950 text-white"
                    >
                        <div className="mx-auto max-w-6xl px-6 text-center">
                        <h1 className="text-4xl font-extrabold leading-tight tracking-tight lg:text-3xl text-white drop-shadow-xl">
                            SoloPM@TLP – Project Management & Secure File Storage
                        </h1>

                        <p className="mx-auto mt-6 max-w-2xl text-lg text-slate-300">
                            Manage tasks, track progress, collaborate with your team,
                            and securely store files — all in one unified workspace.
                        </p>

                        <motion.div
                            initial={{ opacity: 0, y: 40, scale: 0.95 }}
                            animate={{ opacity: 1, y: 0, scale: 1 }}
                            transition={{ duration: 1, ease: [0.22, 1, 0.36, 1] }}
                            whileHover={{ y: -8 }}
                            className="mt-14 flex justify-center"
                        >
                            <img
                                src="https://images.unsplash.com/photo-1551434678-e076c223a692?q=80&w=1200&auto=format&fit=crop"
                                alt="Project management dashboard"
                                className="rounded-xl shadow-2xl max-w-3xl"
                            />
                        </motion.div>

                        <div className="mt-10 flex justify-center gap-4">

                            <a
                                href="https://connect.viber.com/business/b64ff9a8-b60a-11ef-83d2-865b7fa6bf32"
                                target="_blank"
                                rel="noopener noreferrer"
                                className="rounded-lg border border-slate-300 px-8 py-3 text-slate-900 transition hover:bg-gray-100 dark:border-slate-600 dark:text-white dark:hover:bg-gray-800"
                            >
                                Contact Admin
                            </a>

                            <a
                                href="/into"
                                className="rounded-lg bg-black px-8 py-3 text-white transition hover:opacity-80 dark:bg-white dark:text-black"
                            >
                                Login
                            </a>
                        </div>
                        </div>
                    </motion.section>

                    {/* FEATURES */}
                    <motion.section
                        initial={{ opacity: 0, y: 50 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        transition={{ duration: 0.6 }}
                        className="w-full bg-white px-6 py-28 dark:bg-[#0f172a]"
                    >
                        <div className="mx-auto max-w-6xl text-center">
                            <h2 className="text-3xl font-bold text-slate-900 dark:text-white">
                                Powerful Features
                            </h2>

                            <div className="mt-14 grid gap-10 lg:grid-cols-3">
                                {[
                                    {
                                        title: 'Project Tracking',
                                        desc: 'Create projects, assign tasks, set deadlines, and monitor team performance in real-time.',
                                    },
                                    {
                                        title: 'Secure Cloud Storage',
                                        desc: 'Upload, manage, and share documents with secure and organized file storage.',
                                    },
                                    {
                                        title: 'Team Collaboration',
                                        desc: 'Comment on tasks, track activity, and stay aligned with instant updates.',
                                    },
                                ].map((item, i) => (
                                    <motion.div
                                        key={i}
                                        whileHover={{ scale: 1.05 }}
                                        className="rounded-2xl bg-gradient-to-br from-white to-gray-100 p-8 shadow-lg transition hover:shadow-2xl dark:from-slate-800 dark:to-slate-900"
                                    >
                                        <h3 className="text-xl font-semibold text-slate-900 dark:text-white">
                                            {item.title}
                                        </h3>
                                        <p className="mt-4 text-slate-700 dark:text-slate-300">
                                            {item.desc}
                                        </p>
                                    </motion.div>
                                ))}
                            </div>
                        </div>
                    </motion.section>

                    {/* WHY SOLOPM */}
                    <motion.section
                        initial={{ opacity: 0, y: 50 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        transition={{ duration: 0.6 }}
                        className="w-full px-6 py-28 bg-slate-950 text-white"
                    >
                        <div className="mx-auto max-w-4xl text-center">
                            <h2 className="text-3xl font-bold text-white">
                                Why Choose SoloPM?
                            </h2>

                            <p className="mt-8 text-lg text-slate-300">
                                Stop switching between multiple tools. SoloPM combines
                                project management and file storage into a single
                                streamlined platform designed for productivity and clarity.
                            </p>
                        </div>
                    </motion.section>

                    {/* USER FEEDBACK */}
                    <motion.section
                        initial={{ opacity: 0, y: 50 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        transition={{ duration: 0.6 }}
                        className="w-full bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 px-6 py-28 text-white"
                    >
                        <div className="mx-auto max-w-6xl text-center">
                            <h2 className="text-3xl font-semibold">
                                What Users Say
                            </h2>

                            <div className="mt-14 grid gap-8 lg:grid-cols-3">
                                {[
                                    'SoloPM replaced 3 separate tools for our startup.',
                                    'File management is simple, clean and secure.',
                                    'Our team productivity increased dramatically.',
                                ].map((text, i) => (
                                    <motion.div
                                        key={i}
                                        whileHover={{ scale: 1.05 }}
                                        className="rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md p-8 shadow-xl hover:scale-105 transition"
                                    >
                                        <p className="text-white">
                                            “{text}”
                                        </p>
                                    </motion.div>
                                ))}
                            </div>
                        </div>
                    </motion.section>

                    {/* FOOTER */}
                    <footer className="w-full bg-slate-950 text-slate-300">
                        <div className="mx-auto max-w-7xl px-6 py-20">
                            <div className="grid gap-12 md:grid-cols-2 lg:grid-cols-5">

                                {/* Brand */}
                                <div className="lg:col-span-2">
                                    <h3 className="text-2xl font-bold text-white">
                                        SoloPM
                                    </h3>
                                    <p className="mt-4 max-w-md text-slate-400">
                                        SoloPM helps teams manage projects, collaborate efficiently,
                                        and securely store files in one powerful and streamlined workspace.
                                    </p>

                                    <div className="mt-6 flex gap-4">
                                        <a href="#" className="hover:text-white transition">Facebook</a>
                                        <a href="#" className="hover:text-white transition">LinkedIn</a>
                                        <a href="#" className="hover:text-white transition">YouTube</a>
                                        <a href="#" className="hover:text-white transition">TikTok</a>
                                    </div>
                                </div>

                                {/* Product */}
                                <div>
                                    <h4 className="text-sm font-semibold uppercase tracking-wider text-white">
                                        Product
                                    </h4>
                                    <ul className="mt-4 space-y-3 text-sm">
                                        <li><a href="#" className="hover:text-white transition">Features</a></li>
                                        <li><a href="#" className="hover:text-white transition">Pricing</a></li>
                                        <li><a href="#" className="hover:text-white transition">Security</a></li>
                                        <li><a href="#" className="hover:text-white transition">Roadmap</a></li>
                                    </ul>
                                </div>

                                {/* Company */}
                                <div>
                                    <h4 className="text-sm font-semibold uppercase tracking-wider text-white">
                                        Company
                                    </h4>
                                    <ul className="mt-4 space-y-3 text-sm">
                                        <li><a href="#" className="hover:text-white transition">About Us</a></li>
                                        <li><a href="#" className="hover:text-white transition">Careers</a></li>
                                        <li><a href="#" className="hover:text-white transition">Blog</a></li>
                                        <li><a href="#" className="hover:text-white transition">Contact</a></li>
                                    </ul>
                                </div>

                                {/* Support */}
                                <div>
                                    <h4 className="text-sm font-semibold uppercase tracking-wider text-white">
                                        Support
                                    </h4>
                                    <ul className="mt-4 space-y-3 text-sm">
                                        <li><a href="#" className="hover:text-white transition">Help Center</a></li>
                                        <li><a href="#" className="hover:text-white transition">Documentation</a></li>
                                        <li><a href="#" className="hover:text-white transition">Privacy Policy</a></li>
                                        <li><a href="#" className="hover:text-white transition">Terms of Service</a></li>
                                    </ul>
                                </div>
                            </div>

                            {/* Divider */}
                            <div className="mt-16 border-t border-slate-800 pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-sm">
                                <p className="text-slate-500">
                                    © {new Date().getFullYear()} SoloPM@TLP. All rights reserved.
                                </p>

                                <div className="flex gap-6 text-slate-500">
                                    <a href="#" className="hover:text-white transition">Privacy</a>
                                    <a href="#" className="hover:text-white transition">Terms</a>
                                    <a href="#" className="hover:text-white transition">Cookies</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </>
    );
}
