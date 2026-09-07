// ==========================================
// THREE.JS HERO SCENE
// Lightweight background object system for the homepage hero area.
// ==========================================

import * as THREE from "three";

(function () {
  const heroContainer = document.getElementById("hero-3d");
  if (!heroContainer) {
    return;
  }

  try {
    const width = heroContainer.clientWidth;
    const height = heroContainer.clientHeight;

    if (!width || !height) {
      return;
    }

    const prefersReducedMotion = window.matchMedia(
      "(prefers-reduced-motion: reduce)",
    ).matches;

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(42, width / height, 0.1, 1000);
    camera.position.z = 12;

    const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 1.8));
    renderer.setSize(width, height);
    heroContainer.appendChild(renderer.domElement);

  const ambientLight = new THREE.AmbientLight(0xffb067, 1.4);
  scene.add(ambientLight);

  const pointLight = new THREE.PointLight(0xff7a00, 12, 50, 2);
  pointLight.position.set(5, 8, 10);
  scene.add(pointLight);

  const group = new THREE.Group();
  scene.add(group);

  const material = new THREE.MeshStandardMaterial({
    color: 0xff6a00,
    emissive: 0x331900,
    metalness: 0.45,
    roughness: 0.35,
    wireframe: true,
  });

  let objects = [];
  const baseCount = window.innerWidth < 768 ? 8 : 16;

  for (let i = 0; i < baseCount; i += 1) {
    const geometry = new THREE.IcosahedronGeometry(
      0.8 + Math.random() * 0.8,
      1,
    );
    const mesh = new THREE.Mesh(geometry, material.clone());
    mesh.position.set(
      (Math.random() - 0.5) * 12,
      (Math.random() - 0.5) * 8,
      (Math.random() - 0.5) * 6,
    );
    mesh.rotation.set(
      Math.random() * Math.PI,
      Math.random() * Math.PI,
      Math.random() * Math.PI,
    );
    mesh.userData.speed = 0.5 + Math.random() * 1.2;
    group.add(mesh);
    objects.push(mesh);
  }

  const particleGeometry = new THREE.BufferGeometry();
  const particleCount = window.innerWidth < 768 ? 160 : 320;
  const positions = new Float32Array(particleCount * 3);

  for (let i = 0; i < particleCount; i += 1) {
    positions[i * 3] = (Math.random() - 0.5) * 16;
    positions[i * 3 + 1] = (Math.random() - 0.5) * 10;
    positions[i * 3 + 2] = (Math.random() - 0.5) * 8;
  }

  particleGeometry.setAttribute(
    "position",
    new THREE.BufferAttribute(positions, 3),
  );

  const particles = new THREE.Points(
    particleGeometry,
    new THREE.PointsMaterial({
      color: 0xff9d3c,
      size: 0.055,
      transparent: true,
      opacity: 0.8,
    }),
  );
  scene.add(particles);

  let mouseX = 0;
  let mouseY = 0;

  if (!prefersReducedMotion) {
    window.addEventListener("pointermove", (event) => {
      mouseX = (event.clientX / window.innerWidth) * 2 - 1;
      mouseY = -(event.clientY / window.innerHeight) * 2 + 1;
    });
  }

  const animate = () => {
    requestAnimationFrame(animate);

    const time = performance.now() * 0.0005;
    group.rotation.y += 0.002;
    group.rotation.x = mouseY * 0.35;
    group.rotation.z = mouseX * 0.08;

    objects.forEach((mesh, index) => {
      mesh.rotation.x += 0.003 + index * 0.0005;
      mesh.rotation.y += 0.004 + index * 0.0006;
      mesh.position.y += Math.sin(time * mesh.userData.speed + index) * 0.0009;
    });

    particles.rotation.y += 0.0008;
    particles.rotation.x += 0.0004;

    renderer.render(scene, camera);
  };

  animate();

    const resizeScene = () => {
      const resizedWidth = heroContainer.clientWidth;
      const resizedHeight = heroContainer.clientHeight;

      if (!resizedWidth || !resizedHeight) return;

      camera.aspect = resizedWidth / resizedHeight;
      camera.updateProjectionMatrix();
      renderer.setSize(resizedWidth, resizedHeight);
    };

    window.addEventListener("resize", resizeScene);
  } catch (error) {
    console.error("Portfolio 3D scene could not be initialized:", error);
  }
})();
